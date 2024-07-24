<?php
session_start();
error_reporting(0);
include("include/config.php");

// Check if OTP is stored in the session
if (!isset($_SESSION['otp']) || !isset($_SESSION['email'])) {
    // Redirect if OTP or email is not set
    header('location:forgot-password.php');
    exit();
}

// Handle form submission to verify OTP
if(isset($_POST['submit'])){
    $enteredOTP = $_POST['otp'];
    $storedOTP = $_SESSION['otp'];
    $email = $_SESSION['email'];

    // Check if entered OTP matches the stored OTP
    if($enteredOTP == $storedOTP) {
        // Redirect to reset password page if OTP is correct
        header('location:reset-password.php');
        exit();
    } else {
        $error = "Incorrect OTP. Please try again.";
    }
}

// JavaScript to detect popup window closure and redirect to forgot-password.php
echo '<script>
    // Function to detect when the popup window is closed
    function popupClosed() {
        window.location.href = "forgot-password.php"; // Redirect to forgot-password.php
    }

    // Add event listener to detect popup window closure
    window.addEventListener("unload", popupClosed);
</script>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify OTP</title>
    <link rel="icon" href="../h.jpg">

    <style>
        /* Styles for the popup container */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .popup-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: rgba(0, 0, 0, 0.5);
        }
        
        .otp-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            width: 100%;
        }

        .otp-form h2 {
            margin-top: 0;
            text-align: center;
            color: #333;
        }

        .otp-form p {
            color: red;
            margin-bottom: 15px;
        }

        .otp-form label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .otp-form input[type="text"] {
            width: calc(100% - 10px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .otp-form button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .otp-form button[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Styles for the cancel button */
        .otp-form .cancel-btn {
            width: 100%;
            padding: 10px;
            background-color: #ccc;
            color: #333;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .otp-form .cancel-btn:hover {
            background-color: #aaa;
        }
    </style>
</head>
<body>

<div class="popup-container">
    <div class="otp-form">
        <h2>Verify OTP</h2>
        <?php if(isset($error)) { ?>
            <p><?php echo $error; ?></p>
        <?php } ?>

        <form method="post">
            <label for="otp">Enter OTP:</label>
            <input type="text" name="otp" id="otp" required>
            <button type="submit" name="submit">Verify OTP</button>
            <button class="cancel-btn" onclick="window.location.href='forgot-password.php';" type="button">Cancel</button>
        </form>
    </div>
</div>

</body>
</html>
