<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password CareFund</title>
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
        .btn-container {
            text-align: center;
            margin: 30px 0;
        }
        .btn {
            display: inline-block;
            background-color: #2ea391;
            color: #ffffff;
            padding: 14px 28px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(46, 163, 145, 0.2);
        }
        .link-text {
            font-size: 12px;
            color: #718096;
            word-break: break-all;
            margin-top: 20px;
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
        <div class="title">Reset Password Anda</div>
        
        <p class="greeting">Halo <strong>{{ $fullName }}</strong>,</p>
        
        <p class="greeting">Kami menerima permintaan untuk mereset password akun CareFund Anda. Silakan klik tombol di bawah ini untuk mengatur ulang password Anda:</p>
        
        <div class="btn-container">
            <a href="{{ $resetUrl }}" class="btn">Reset Password</a>
        </div>
        
        <p class="greeting" style="font-size: 14px; color: #718096;">Tautan ini hanya berlaku selama <strong>60 menit</strong>. Jika Anda tidak merasa meminta reset password, abaikan email ini.</p>
        
        <div class="link-text">
            Atau salin tautan berikut ke browser Anda:<br>
            <a href="{{ $resetUrl }}" style="color: #2ea391;">{{ $resetUrl }}</a>
        </div>
        
        <div class="footer">
            &copy; {{ date('Y') }} CareFund. All rights reserved.<br>
            Jl. Sudirman No. 123, Jakarta Pusat, Indonesia.<br>
            Membangun Kebaikan Bersama.
        </div>
    </div>
</body>
</html>
