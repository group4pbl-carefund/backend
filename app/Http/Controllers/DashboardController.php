<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Program;
use App\Models\ProgramCampaign;
use App\Models\Distribution;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    private function calculatePenerimaManfaat()
    {
        $activeCampaigns = ProgramCampaign::with('program')
            ->whereHas('program', function($query) {
                $query->whereIn('status', ['ACTIVE', 'COMPLETED', 'active', 'completed', 'approved']);
            })->get();

        $total = 0;
        foreach ($activeCampaigns as $campaign) {
            $type = strtolower($campaign->program->beneficiary_type ?? 'lembaga');
            $amount = $campaign->current_amount ?? 0;

            if (in_array($type, ['diri sendiri', 'diri_sendiri', 'self', 'orang lain', 'orang_lain', 'others', 'individu', 'personal'])) {
                $total += 1;
            } elseif (in_array($type, ['keluarga', 'family'])) {
                $total += 4; // Estimasi rata-rata anggota keluarga
            } else {
                // Yayasan/Lembaga/Bencana Alam/Umum
                $total += ceil($amount / 200000); // Rp 200.000 per orang
            }
        }

        return $total;
    }

    public function index()
    {
        // 1. Stats
        $totalDana = ProgramCampaign::whereHas('program', function($query) {
            $query->whereIn('status', ['ACTIVE', 'COMPLETED', 'active', 'completed', 'approved']);
        })->sum('current_amount');

        $penerimaManfaat = $this->calculatePenerimaManfaat();
        $programAktif = Program::whereIn('status', ['ACTIVE', 'active', 'approved'])
            ->where(function($query) {
                $query->whereNull('end_date')
                      ->orWhere('end_date', '>=', \Carbon\Carbon::now());
            })
            ->count();

        $distribusiSelesai = Distribution::count();

        // 2. Donation Trend (Last 6 Months)
        $trendData = [];
        $months = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $months[] = $month->translatedFormat('M'); // Jan, Feb, etc.
            
            $sum = Donation::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->whereIn('payment_status', ['PAID', 'SUCCESS', 'completed', 'COMPLETED'])
                ->sum('amount');
            $trendData[] = $sum;
        }

        // 3. Category Data (Based on Donation Amount)
        $categories = DB::table('donations')
            ->join('programs', 'donations.program_id', '=', 'programs.program_id')
            ->whereIn('donations.payment_status', ['PAID', 'SUCCESS', 'completed', 'COMPLETED'])
            ->select('programs.category', DB::raw('SUM(donations.amount) as total'))
            ->groupBy('programs.category')
            ->get();
            
        $categoryLabels = [];
        $categoryCounts = [];
        foreach ($categories as $cat) {
            $categoryLabels[] = $cat->category ?? 'Lainnya';
            $categoryCounts[] = $cat->total;
        }

        // 4. Featured Programs (Hampir Selesai)
        $featuredProgramsRaw = ProgramCampaign::with(['program' => function($query) {
                $query->withCount('donations');
            }])
            ->whereHas('program', function($query) {
                $query->whereIn('status', ['active', 'approved'])
                      ->where(function($q) {
                          $q->whereNull('end_date')
                            ->orWhere('end_date', '>=', Carbon::now());
                      });
            })
            ->get()
            ->filter(function($campaign) {
                $target = $campaign->program->target_amount ?? 1;
                $progress = ($campaign->current_amount / $target) * 100;
                return $progress < 100; // belum 100%
            })
            ->sortByDesc(function($campaign) {
                $target = $campaign->program->target_amount ?? 1;
                return ($campaign->current_amount / $target) * 100;
            })
            ->take(3);
            
        $featuredPrograms = $featuredProgramsRaw->map(function($campaign) {
            $p = $campaign->program;
            $collected = $campaign->current_amount ?? 0;
            $target = $p->target_amount ?? 1; // avoid div 0
            $progress = min(100, round(($collected / $target) * 100));
            
            return [
                'campaign_id' => $campaign->campaign_id,
                'category' => strtoupper($p->category ?? 'Umum'),
                'location' => 'INDONESIA', 
                'title' => $p->program_name,
                'collected' => 'Rp ' . number_format($collected, 0, ',', '.'),
                'target' => 'Rp ' . number_format($target, 0, ',', '.'),
                'progress' => $progress,
                'deadline' => $p->end_date ? Carbon::parse($p->end_date)->diffForHumans() : 'Tanpa batas',
                'donors' => ($p->donations_count ?? 0) . ' Donatur'
            ];
        })->values();

        // 5. Recent Activities
        $activitiesRaw = Program::orderBy('created_at', 'desc')->get();
        $activities = $activitiesRaw->map(function($p) {
            return [
                'title' => $p->program_name,
                'date' => $p->created_at->translatedFormat('d M Y'),
                'category' => $p->category ?? 'Umum'
            ];
        });

        // 6. Recent Distributions
        $distributionsRaw = Distribution::with('program')->where('amount', '>', 0)->orderBy('created_at', 'desc')->get();
        $distributions = $distributionsRaw->map(function($d) {
            return [
                'program_name' => $d->program->program_name ?? 'Program Umum',
                'amount' => 'Rp ' . number_format($d->amount, 0, ',', '.'),
                'status' => strtoupper($d->status ?? 'PROSES'),
                'date' => $d->created_at->translatedFormat('d M Y')
            ];
        });

        return response()->json([
            'success' => true,
            'data' => [
                'stats' => [
                    'total_dana' => 'Rp ' . number_format($totalDana, 0, ',', '.'),
                    'penerima_manfaat' => number_format($penerimaManfaat, 0, ',', '.') . ' Jiwa',
                    'program_aktif' => $programAktif . ' Program',
                    'distribusi_selesai' => $distribusiSelesai . ' Kasus'
                ],
                'donation_trend' => [
                    'labels' => $months,
                    'data' => $trendData
                ],
                'category_data' => [
                    'labels' => empty($categoryLabels) ? ['Belum ada'] : $categoryLabels,
                    'data' => empty($categoryCounts) ? [1] : $categoryCounts
                ],
                'featured_programs' => $featuredPrograms,
                'activities' => $activities,
                'distributions' => $distributions
            ]
        ]);
    }

    public function publicStats()
    {
        $totalDana = ProgramCampaign::whereHas('program', function($query) {
            $query->whereIn('status', ['ACTIVE', 'COMPLETED', 'active', 'completed', 'approved']);
        })->sum('current_amount');

        $penerimaManfaat = $this->calculatePenerimaManfaat();
        
        $donaturAktif = \App\Models\Donation::whereIn('payment_status', ['completed', 'PAID', 'SUCCESS'])->distinct('user_id')->count('user_id');
        if ($donaturAktif == 0) $donaturAktif = User::count(); 

        $kampanyeSukses = Program::whereIn('status', ['completed', 'COMPLETED'])->count();
        if ($kampanyeSukses == 0) $kampanyeSukses = Program::whereIn('status', ['approved', 'active'])->count();

        // Format angka untuk Rupiah
        $formatRupiah = function($num) {
            if ($num >= 1000000000) {
                return 'Rp ' . round($num / 1000000000, 1) . ' M';
            } elseif ($num >= 1000000) {
                return 'Rp ' . round($num / 1000000, 1) . ' Jt';
            }
            return 'Rp ' . number_format($num, 0, ',', '.');
        };

        // Format angka (misal: 10K+)
        $formatNumber = function($num) {
            if ($num >= 1000) {
                return round($num / 1000, 1) . 'K+';
            }
            return $num . '+';
        };

        return response()->json([
            'success' => true,
            'data' => [
                'total_dana' => $formatRupiah($totalDana),
                'dana_tersalurkan' => $formatRupiah($totalDana),
                'penerima_manfaat' => number_format($penerimaManfaat, 0, ',', '.') . ' +',
                'donatur_aktif' => $formatNumber($donaturAktif),
                'kampanye_sukses' => $formatNumber($kampanyeSukses)
            ]
        ]);
    }
}
