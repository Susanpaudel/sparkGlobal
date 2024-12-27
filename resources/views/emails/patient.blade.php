<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thank You for Contacting Spa Nepal</title>
</head>

<body style="font-family: 'Arial', sans-serif; background-color: #f4f4f4; color: #333; margin: 0; padding: 20px;">

    <div
        style="max-width: 600px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">

        <!-- Logo -->
        <div style="text-align: center; margin-bottom: 20px;">
            <img src="{{ \App\Helpers\MyHelper::getSiteConfig('header_site_logo') }}" alt="Spa Nepal Logo" style="max-width: 100%; height:5rem">
        </div>

        <h1>Thank You for Contacting Us!</h1>

        <p>Dear {{ $name }},</p>

        <p>We have received your message and want to express our gratitude for reaching out to Spa Nepal.</p>

        <p>Please be assured that our team is reviewing your inquiry, and we will get back to you shortly. In the meantime, if you need immediate assistance, feel free to call us at <strong>{{ \App\Helpers\MyHelper::getSiteConfig('contact') }}</strong>.</p>

        <p>We appreciate your interest and look forward to assisting you.</p>

        <hr>

        <p>Best regards,</p>
        <p>Spa Nepal</p>
    </div>

</body>

</html>
