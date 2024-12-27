<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 20px;
        }
        p {
            line-height: 1.6;
            font-size: 16px;
        }
        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #555;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>New Contact Form Submission</h2>
        <p>Hello,</p>

        <p>You have received a new contact form submission with the following details:</p>

        <p><strong>Name:</strong> {{ $name }}</p>
        <p><strong>Email:</strong> {{ $email }}</p>
        <p><strong>Phone Number:</strong> {{ $phone }}</p>
        <p><strong>Treatment:</strong> {{ $treatment }}</p>
        <p><strong>Message:</strong> {{ $messege }}</p>

        <p>Please review the submission and respond to the inquiry as soon as possible. If you have any questions, feel free to reach out to the admin team.</p>

        <div class="footer">
            <p>Kind Regards,</p>
            <p><strong>Spa Nepal | Support Team</strong></p>
            <p>This is an automated message. Please do not reply directly to this email.</p>
        </div>
    </div>

</body>

</html>
