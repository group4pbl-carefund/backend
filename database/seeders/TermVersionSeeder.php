<?php

namespace Database\Seeders;

use App\Models\TermVersion;
use Illuminate\Database\Seeder;

class TermVersionSeeder extends Seeder
{
    public function run(): void
    {
        $terms = [
            [
                'version_number' => '1.0',
                'content' => 'Ketentuan dan Kondisi Penggunaan Carefund

1. Pendahuluan
Dengan mengakses dan menggunakan platform Carefund, Anda setuju untuk terikat oleh ketentuan dan kondisi ini. Jika Anda tidak setuju dengan bagian mana pun dari ketentuan ini, Anda tidak boleh menggunakan layanan kami.

2. Definisi
- "Platform"指的是 Carefund 网站和移动应用程序
- "Pengguna"指使用平台进行捐赠或筹款活动的个人或实体
- "Donasi"指用户向平台上的活动提供的资金

3. Penggunaan Platform
3.1 Anda必须是年满18岁的个人或法人实体
3.2 Anda setuju untuk提供准确、完整的信息
3.3 Anda setuju untuk tidak从事任何非法活动

4. Kebijakan Privasi
Kami重视您的隐私并致力于保护您的个人信息。详情请参阅我们的隐私政策。

5. Kebijakan Pengembalian Dana
5.1 所有捐款均不可退还，除非法律要求
5.2 如果活动未达到目标，捐款将退还给捐赠者

6. Batasan Tanggung Jawab
Carefund不对通过平台进行的任何交易纠纷负责。

7. Perubahan Ketentuan
Kami保留随时修改这些条款的权利。继续使用平台即表示您接受修改后的条款。',
                'effective_date' => '2026-01-01',
            ],
            [
                'version_number' => '1.1',
                'content' => 'Ketentuan dan Kondisi Penggunaan Carefund (Versi 1.1)

1. Pendahuluan
Selamat datang di Carefund. Dengan mengakses platform Carefund, Anda menyetujui untuk terikat oleh ketentuan dan kondisi berikut.

2. Layanan yang Disediakan
2.1 Carefund menyediakan平台 untuk penggalangan dana untuk berbagai tujuan sosial
2.2 Platform memfasilitasi koneksi antara donatur dan penerima manfaat
2.3 Kami menyediakanTrasparansi dalam pengelolaan dana

3. Kewajiban Pengguna
3.1 Pengguna wajib提供真实准确的信息
3.2 Pengguna tidak boleh menggunakan平台 untuk目的非法
3.3 Pengguna wajib保持账户信息最新

4. Kebijakan Donasi
4.1 Donasi yang dilakukan melalui platform bersifat final dan tidak dapat diminta kembali
4.2 Platform berhak memverifikasi keaslian donasi
4.3 Donatur akan收到确认收据

5. Keamanan
5.1 Kami采用安全措施保护用户数据
5.2 Pengguna disarankan menjaga kredensial登录信息
5.3 Laporkan任何可疑活动立即

6. Hak Kekayaan Intelektual
Seluruh konten dan materi di platform adalah milik Carefund atau pemberi lisensi masing-masing.

7. Penyelesaian Sengketa
任何争议将通过友好协商解决。

8. Perubahan Ketentuan
Carefund berhak修改这些条款，恕不另行通知。',
                'effective_date' => '2026-03-15',
            ],
            [
                'version_number' => '1.2',
                'content' => 'Ketentuan dan Kondisi Penggunaan Carefund (Versi 1.2) - Terbaru

BAB 1 - KETENTUAN UMUM

Pasal 1 - Definisi
1. Carefund: Platform penggalangan dana online
2. Pengguna: Siapa saja yang mengakses platform
3. Donatur: Pengguna yang memberikan donasi
4. Pembuat Kampanye: Pengguna yang membuat kampanye penggalangan dana
5. Kampanye: Program penggalangan dana di platform

Pasal 2 - Ruang Lingkup
Ketentuan ini mengatur penggunaan platform Carefund oleh seluruh pengguna.

Pasal 3 - Pendaftaran Akun
3.1 Pengguna wajib mendaftar akun dengan informasi yang valid
3.2 Satu pengguna hanya boleh memiliki satu akun
3.3 Akun harus diverifikasi melalui email

BAB 2 - KETENTUAN DONASI

Pasal 4 - Proses Donasi
4.1 Donasi dapat dilakukan melalui berbagai metode pembayaran
4.2 Donatur akan收到电子收据
4.3 Donasi dalam mata uang Rupiah (IDR)

Pasal 4 - Kebijakan Pengembalian
4.1 Donasi tidak dapat dikembalikan kecuali dalam kasus khusus
4.2 Kasus khusus mencakup：活动取消、欺诈行为

BAB 3 - KEWAJIBAN DAN HAK

Pasal 5 - Kewajiban Pembuat Kampanye
5.1 Menyediakan informasi yang akurat dan jujur
5.2 Menggunakan dana sesuai dengan tujuan yang dinyatakan
5.3 Menyediakan更新 tentang perkembangan kampanye

Pasal 6 - Hak Carefund
6.1 Carefund berhak menangguhkan或终止任何违反这些条款的账户
6.2 Carefund有权收取服务费用
6.3 Carefund有权更改平台功能

BAB 4 - KEAMANAN DAN PRIVASI

Pasal 7 - Perlindungan Data
Seluruh data pengguna akan根据适用法律保护。

Pasal 8 - Keamanan Transaksi
Transaksi diproses melalui sistem keamanan yang terenkripsi.

BAB 5 - KETENTUAN PENUTUP

Ketentuan ini efektif sejak tanggal publikasi dan dapat berubah sewaktu-waktu.',
                'effective_date' => '2026-04-01',
            ],
        ];

        foreach ($terms as $term) {
            TermVersion::create($term);
        }
    }
}