<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Successful Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
        }
        .header {
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
        .footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Congratulations</h1>
        </div>
        <div class="content">
            <p>Dear {{student_name}},</p>
            <p>Thank you for registering. We appreciate your interest and look forward to serving you..</p>
            <p>Below is your verification code:</p>
            <h2 style="text-align: center;">{{verification_code}}</h2>
            <p>Use this verification code to verify the RFID tag. Present a RFID tag to your teacher to complete the process.</p>
            <p>If you have any questions or feedback, feel free to reply to this email. We'd love to hear from you!</p>
            <p>Best regards,</p>
            <p>Support Dev: ATMS</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 E-ATMSYSTEM. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
