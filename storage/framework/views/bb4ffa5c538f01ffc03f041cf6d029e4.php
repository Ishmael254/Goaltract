
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found - Goaltract.com</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>"> 
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
        .countdown {
            font-size: 24px;
            margin: 20px 0;
            color: #333;
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let countdown = 5;
            const countdownElement = document.getElementById('countdown');

            function updateCountdown() {
                countdownElement.textContent = countdown;
                if (countdown <= 0) {
                    window.location.href = '<?php echo e(url('/')); ?>'; // Redirect to home
                } else {
                    countdown--;
                    setTimeout(updateCountdown, 1000); // Update every second
                }
            }

            updateCountdown();
        });
    </script>
</head>
<body>

<div class="error-container">
    <div class="error-title">404</div>
    <p class="error-message">Oops! The page you're looking for can't be found.</p>
    <p class="countdown">Looks like you are lost, taking you home in <span id="countdown">5</span> seconds.</p>
    <a href="<?php echo e(url('/')); ?>" class="home-button">Go Back to Home</a>
</div>

</body>
</html>
<?php /**PATH C:\Users\Prince\Desktop\GoalTract\resources\views/errors/404.blade.php ENDPATH**/ ?>