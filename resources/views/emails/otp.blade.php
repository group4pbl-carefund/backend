<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP CareFund</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f0f9f7;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 4px 12px rgba(46, 163, 145, 0.05);
            border: 1px solid #e0f2f1;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 28px;
            font-weight: 800;
            color: #2ea391;
            letter-spacing: -1px;
            text-decoration: none;
        }
        .title {
            font-size: 22px;
            font-weight: 700;
            color: #2c3e50;
            text-align: center;
            margin-bottom: 10px;
        }
        .greeting {
            font-size: 16px;
            color: #4a5568;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .otp-container {
            background-color: #f5fbf9;
            border: 2px dashed #2ea391;
            border-radius: 16px;
            padding: 24px;
            text-align: center;
            margin: 30px 0;
        }
        .otp-code {
            font-size: 40px;
            font-weight: 800;
            color: #2ea391;
            letter-spacing: 12px;
            margin: 0;
        }
        .expiry-text {
            font-size: 13px;
            color: #718096;
            margin-top: 10px;
        }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #edf2f7;
            text-align: center;
            font-size: 12px;
            color: #a0aec0;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="#" class="logo">🌿 CareFund</a>
        </div>
        <div class="title">Verifikasi Akun Baru Anda</div>
        
        <p class="greeting">Halo <strong>{{ $fullName }}</strong>,</p>
        
        <p class="greeting">Terima kasih telah mendaftar di CareFund. Untuk menyelesaikan proses pendaftaran dan memverifikasi alamat email Anda, silakan masukkan 6-digit kode OTP di bawah ini pada halaman verifikasi:</p>
        
        <div class="otp-container">
            <div class="otp-code">{{ $otp }}</div>
            <div class="expiry-text">Kode OTP ini berlaku selama <strong>10 menit</strong>. Jangan bagikan kode ini kepada siapa pun.</div>
        </div>
        
        <p class="greeting" style="font-size: 14px; color: #718096;">Jika Anda tidak merasa melakukan pendaftaran akun di platform kami, silakan abaikan email ini.</p>
        
        <div class="footer">
            &copy; 2026 CareFund. All rights reserved.<br>
            Jl. Sudirman No. 123, Jakarta Pusat, Indonesia.<br>
            Membangun Kebaikan Bersama.
        </div>
    </div>
</body>
</html>
