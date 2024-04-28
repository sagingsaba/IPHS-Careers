<?php
session_start();

// Check if user is logged in
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if user's role is not "student", redirect to login page
if($_SESSION['role_id'] !== '2') {
    header("Location: index.php");
    exit();
}

// Get user information from session
$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];

// You can include any additional logic or functionality specific to the dashboard here

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Welcome, <?php echo $fname . " " . $lname; ?>!</h1>
        <p>Your Role: Student</p>
        <a href="logout.php">Logout</a>
    </header>
    <nav>
        <!-- Your navigation links here -->
        <ul>
            <li><a href="#">Link 1</a></li>
            <li><a href="#">Link 2</a></li>
            <li><a href="#">Link 3</a></li>
        </ul>
    </nav>
    <main>
        <!-- Your dashboard content here -->
        <section>
            <h2>Section 1</h2>
            <p>This is the content of section 1.</p>
        </section>
        <section>
            <h2>Section 2</h2>
            <p>This is the content of section 2.</p>
        </section>
        <section>
            <h2>Section 3</h2>
            <p>This is the content of section 3.</p>
        </section>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Your Company Name. All rights reserved.</p>
    </footer>
</body>
</html>
