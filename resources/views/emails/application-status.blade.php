<!DOCTYPE html>
<html>
<head>
    <title>Job Application Status Update</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #4CAF50;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 20px;
        }
        .content p {
            font-size: 16px;
            color: #333333;
            line-height: 1.5;
            margin: 10px 0;
        }
        .content strong {
            color: #4CAF50;
        }
        .footer {
            background-color: #f4f4f9;
            padding: 15px;
            text-align: center;
            font-size: 14px;
            color: #888888;
        }
        .footer a {
            color: #4CAF50;
            text-decoration: none;
        }
        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            color: #ffffff;
            background-color: #4CAF50;
            text-decoration: none;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Application Status Update</h1>
        </div>
        <div class="content">
            <p>Dear <strong>{{ $application->user->name }}</strong>,</p>

            <p>Your application for the position of <strong>{{ $application->job->job_title }}</strong> has been updated.</p>
            
            <p>New Status: <strong>{{ ucfirst(str_replace('_', ' ', $application->status)) }}</strong></p>

            <p>We appreciate your interest in this position and encourage you to visit our platform for further details.</p>
            
            <a href="{{ url('/') }}" class="button">Visit Platform</a>
        </div>
        <div class="footer">
            <p>Thank you,<br>{{ config('app.name') }}</p>
            <p>Need help? <a href="{{ url('/support') }}">Contact Support</a></p>
        </div>
    </div>
</body>
</html>
