<!DOCTYPE html>
<html>
<head>
    <style>
        .email-container {
            font-family: 'Inter', sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8fafc;
        }
        .header {
            background: linear-gradient(135deg, #000052 0%, #0E5393 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 12px 12px 0 0;
        }
        .content {
            background: white;
            padding: 40px;
            border-radius: 0 0 12px 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .otp-code {
            font-size: 36px;
            font-weight: 800;
            color: #0E5393;
            letter-spacing: 10px;
            text-align: center;
            margin: 30px 0;
            padding: 20px;
            background: #f1f5f9;
            border-radius: 8px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #64748b;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1 style="margin:0;">Verification Code</h1>
            <p style="margin:5px 0 0; opacity:0.8;">Brgy. San Miguel II Portal</p>
        </div>
        <div class="content">
            <p>Hello,</p>
            <p>You are requesting to change your password. Please use the verification code below to proceed:</p>
            
            <div class="otp-code">
                {{ $otp }}
            </div>
            
            <p style="color:#64748b; font-size:14px;">This code will expire in 10 minutes. If you did not request this, please ignore this email.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Barangay San Miguel II. All rights reserved.
        </div>
    </div>
</body>
</html>
