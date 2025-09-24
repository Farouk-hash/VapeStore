<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>Vapping System</title>
    <style>
        body {
            font-family: 'Tajawal', Arial, sans-serif;
            background: #eef2f7;
            margin: 0;
            padding: 30px 0;
        }
        .wrapper {
            max-width: 600px;
            margin: auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0px 6px 18px rgba(0,0,0,0.08);
            border: 1px solid #e5e9f2;
        }
        .header {
            background: linear-gradient(135deg, #4a90e2, #357abd);
            color: #fff;
            text-align: center;
            padding: 25px;
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .content {
            padding: 35px 30px;
            color: #444;
            line-height: 1.9;
            font-size: 15px;
        }
        .content p {
            margin: 0 0 15px;
        }
        .button {
            display: inline-block;
            padding: 14px 28px;
            margin: 25px 0;
            background: linear-gradient(135deg, #4a90e2, #357abd);
            color: #fff !important;
            text-decoration: none;
            border-radius: 10px;
            font-weight: bold;
            font-size: 16px;
            box-shadow: 0px 4px 10px rgba(74, 144, 226, 0.3);
            transition: background 0.3s ease;
        }
        .button:hover {
            background: linear-gradient(135deg, #5aa1f2, #468cd1);
        }
        .footer {
            background: #f9fafc;
            text-align: center;
            font-size: 13px;
            color: #888;
            padding: 20px;
            border-top: 1px solid #e5e9f2;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">🚀 Vapping System</div>
        <div class="content">
            <p>مرحباً <strong>{{ $user->name }}</strong> 👋</p>
            <p>لقد استقبلنا طلبًا لإعادة تعيين كلمة المرور الخاصة بحسابك.</p>
            <p style="text-align:center;">
                <a href="{{ $url }}" class="button">إعادة تعيين كلمة المرور</a>
            </p>
            <p>إذا لم تقم بطلب إعادة التعيين، يمكنك تجاهل هذه الرسالة بأمان.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} <strong>Vapping</strong>. جميع الحقوق محفوظة.
        </div>
    </div>
</body>
</html>
