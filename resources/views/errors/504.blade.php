{{-- resources/views/errors/404.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found - Goaltract</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> {{-- Assuming you have a CSS file --}}
    <style>
        body {
            background-color: #f8f9fa; /* Light background */
            color: #333;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .error-container {
            text-align: center;
            max-width: 600px;
            padding: 20px;
            border-radius: 8px;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .error-title {
            font-size: 80px;
            font-weight: bold;
            color: #007bff; /* Goaltract's primary color */
            margin: 0;
        }
        .error-message {
            font-size: 20px;
            margin: 20px 0;
            color: #555;
        }
        .home-button {
            display: inline-block;
            padding: 12px 24px;
            color: white;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .home-button:hover {
            background-color: #0056b3; /* Darker shade for hover */
        }
    </style>
</head>
<body>

<div class="error-container">
    <div class="error-title">404</div>
    <p class="error-message">Oops! The page you're looking for can't be found.</p>
    <a href="{{ url('/') }}" class="home-button">Go Back to Home</a>
</div>

</body>
</html>
