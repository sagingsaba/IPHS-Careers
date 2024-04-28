<?php
session_start();
require_once "include/connect/dbcon.php";

try {
    // Check if the form is submitted
    if(isset($_POST["submit"])){
        // Check if email and password are provided
        if(empty($_POST['email']) || empty($_POST['password'])){
            $message = "Please provide both your email and password for login";
        }
        else{
            // Get email and password from the form
            $email = $_POST['email'];
            $pass = $_POST['password'];

            // Prepare and execute SQL to find user by email
            $sql = "SELECT * FROM user_tb WHERE email = ?";
            $stmt = $pdoConnect->prepare($sql);
            $stmt->execute([$email]);
            
            // Fetch user data
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Check if user exists
            if ($stmt->rowCount() > 0) {
                // Verify password
                if($row && password_verify($pass, $row['password'])){
                    // Start session and set user data
                    $_SESSION['fname'] = $row['fname'];
                    $_SESSION['user_id'] = $row['user_id'];
    
                    // Log the login action
                    $timestamp = date('Y-m-d H:i:s');
                    $sql = "INSERT INTO `log_tb`(`action`, `timestamp`, `user_id`) VALUES (?,?,?)";
                    $stmt = $pdoConnect->prepare($sql);
                    $stmt->execute(["logged in", $timestamp, $row['user_id']]);
    
                    // Redirect based on user role
                    $role = $row['role_id']; // Assuming role_id is used for user role
                    if ($role == 2) { // Regular user
                        header("Location: dashboard.php");
                        exit;
                    } elseif ($role == 1) { // Admin
                        header("Location: admin_dashboard.php"); // Adjust this to your admin dashboard URL
                        exit;
                    } else {
                        // Handle other roles if needed
                    }
                }else{
                    // Incorrect password
                    $message = 'The email or password is incorrect';
                }
            } else {
                // No user found with the given email
                $message = 'No account found with this email. <a href="signup.php">Sign Up</a>'; // Added Sign Up link
            }
        }
    }
} catch (PDOException $error) {
    // Handle database errors
    $message = $error->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="include/image/logo.png">
    <link rel="stylesheet" href="include/styles/globalstyles.css">
    <link rel="stylesheet" href="include/styles/animation.css">
    <script src=".include/js/globaljs.js"></script>
    <title>Log In</title>
</head>
<body>
    <nav><img src="" alt=""></nav>
    <label>iPHS Careers</label> <!-- Corrected label -->
    <div class="nav_btn">
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="services.php">Services</a>
        <a href="faqs.php">FAQs</a>
        <a href="contact_us.php">Contact Us</a>
    </div>

    <div>
        <h2>Login</h2>
        <?php
        if(!empty($message)){
            echo "<p>$message</p>";
        }
        ?>
        <form action="" method="post">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" name="submit" value="Log In">
        </form>
        <div><label>no account? sign up here</label>
        <a href="sign_up.php">Sign Up</a>

    </div>
    </div>
</body>
</html>
