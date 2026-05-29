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
        $programAktif = Program::where('status', 'ACTIVE')->count();
        if ($programAktif == 0) $programAktif = Program::count();

        $distribusiSelesai = Distribution::where('status', 'COMPLETED')->count();
        if ($distribusiSelesai == 0) $distribusiSelesai = Distribution::count();

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

        // 3. Category Data
        $categories = Program::select('category', DB::raw('count(*) as total'))
            ->groupBy('category')
            ->get();
            
        $categoryLabels = [];
        $categoryCounts = [];
        foreach ($categories as $cat) {
            $categoryLabels[] = $cat->category ?? 'Lainnya';
            $categoryCounts[] = $cat->total;
        }

        // 4. Featured Programs
        $featuredProgramsRaw = Program::withCount('donations')
            ->withSum('donations', 'amount')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
            
        $featuredPrograms = $featuredProgramsRaw->map(function($p) {
            $collected = $p->donations_sum_amount ?? 0;
            $target = $p->target_amount ?? 1; // avoid div 0
            $progress = min(100, round(($collected / $target) * 100));
            
            return [
                'category' => strtoupper($p->category ?? 'Umum'),
                'location' => 'INDONESIA', // Placeholder since location doesn't exist
                'title' => $p->program_name,
                'collected' => 'Rp ' . number_format($collected, 0, ',', '.'),
                'target' => 'Rp ' . number_format($target, 0, ',', '.'),
                'progress' => $progress,
                'deadline' => $p->end_date ? Carbon::parse($p->end_date)->diffForHumans() : 'Tanpa batas',
                'donors' => $p->donations_count . ' Donatur'
            ];
        });

        // 5. Recent Activities
        $activitiesRaw = Program::orderBy('created_at', 'desc')->take(4)->get();
        $activities = $activitiesRaw->map(function($p) {
            return [
                'title' => $p->program_name,
                'date' => $p->created_at->translatedFormat('d M Y'),
                'category' => $p->category ?? 'Umum'
            ];
        });

        // 6. Recent Distributions
        $distributionsRaw = Distribution::orderBy('created_at', 'desc')->take(4)->get();
        $distributions = $distributionsRaw->map(function($d) {
            return [
                'amount' => 'Rp ' . number_format($d->amount, 0, ',', '.'),
                'status' => strtoupper($d->status ?? 'PROSES')
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
        $donaturAktif = User::count(); // Estimasi dari total user terdaftar

        // Format angka (misal: 2 Miliar+, 10.000+)
        $formatNumber = function($num) {
            if ($num >= 1000000000) {
                return round($num / 1000000000, 1) . ' Miliar +';
            } elseif ($num >= 1000000) {
                return round($num / 1000000, 1) . ' Juta +';
            } elseif ($num >= 1000) {
                return round($num / 1000, 1) . ' Ribu +';
            }
            return number_format($num, 0, ',', '.') . ' +';
        };

        return response()->json([
            'success' => true,
            'data' => [
                'total_dana' => $formatNumber($totalDana),
                'penerima_manfaat' => number_format($penerimaManfaat, 0, ',', '.') . ' +',
                'donatur_aktif' => number_format($donaturAktif, 0, ',', '.') . ' +'
            ]
        ]);
    }
}
