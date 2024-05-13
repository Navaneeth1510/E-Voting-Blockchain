<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Auto Logout with Countdown</title>
    <script>
    // Initial time in seconds for the timer
    var logoutTime = 30; // 30 seconds

    // Function to update the countdown on the screen and check if it's time to log out
    function updateCountdown() {
        if (logoutTime > 0) {
            document.getElementById("countdown").innerText = "Time remaining: " + logoutTime + " seconds";
            logoutTime--;
            setTimeout(updateCountdown, 1000); // Call this function every second
        } else {
            window.location.href = 'logout.php'; // Redirect when the timer reaches zero
        }
    }

    window.onload = updateCountdown; // Start the countdown when the page loads
    </script>
</head>
<body>
    <h2>Auto Logout Demo with Countdown</h2>
    <p id="countdown">Time remaining: 30 seconds</p> <!-- Display the countdown -->
</body>
</html>
