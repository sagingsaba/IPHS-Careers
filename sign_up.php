<?php
require_once "include/connect/dbcon.php";

$message = ""; // Initialize message variable

// Fetch strands from the database
$sql_fetch_strands = "SELECT * FROM strand_tb";
$stmt_fetch_strands = $pdoConnect->prepare($sql_fetch_strands);
$stmt_fetch_strands->execute();
$strands = $stmt_fetch_strands->fetchAll(PDO::FETCH_ASSOC);

try {
    if(isset($_POST["submit"])){
        // Check if all required fields are provided
        if(empty($_POST['email']) || empty($_POST['password']) || empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['dob']) || empty($_POST['strand'])){
            $message = "Please provide all the required information.";
        }
        else{
            // Get input data
            $email = $_POST['email'];
            $password = $_POST['password'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $dob = $_POST['dob'];
            $strand_id = $_POST['strand'];

            // Check if email already exists in the database
            $sql_check_email = "SELECT * FROM user_tb WHERE email = ?";
            $stmt_check_email = $pdoConnect->prepare($sql_check_email);
            $stmt_check_email->execute([$email]);
            if ($stmt_check_email->rowCount() > 0) {
                $message = "Email already exists. Please choose a different one.";
            } else {
                // Hash the password
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Insert the user into the database
                $sql_insert_user = "INSERT INTO user_tb (fname, lname, email, password, dob, role_id, strand_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt_insert_user = $pdoConnect->prepare($sql_insert_user);
                $stmt_insert_user->execute([$fname, $lname, $email, $hashedPassword, $dob, 2, $strand_id]); // Assuming role_id for student is 2

                // Check if the user is successfully inserted
                if ($stmt_insert_user->rowCount() > 0) {
                    $message = "Registration successful. You can now <a href='index.php'>log in</a>.";
                } else {
                    $message = "Registration failed. Please try again later.";
                }
            }
        }
    }
} catch (PDOException $error) {
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
    <title>Sign Up</title>
</head>
<body>
    <nav><img src="" alt=""></nav>
    <label>iPHS Careers</label> <!-- Is this the correct label? -->
    <div class="nav_btn">
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="services.php">Services</a>
        <a href="faqs.php">FAQs</a>
        <a href="contact_us.php">Contact Us</a>
    </div>

    <div>
        <h2>Sign Up</h2>
        <?php
        if(!empty($message)){
            echo "<p>$message</p>";
        }
        ?>
        <form action="" method="post">
            <label for="fname">First Name:</label><br>
            <input type="text" id="fname" name="fname" required><br>
            <label for="lname">Last Name:</label><br>
            <input type="text" id="lname" name="lname" required><br>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br>
            <label for="dob">Date of Birth:</label><br>
            <input type="date" id="dob" name="dob" required><br>
            <label for="strand">Choose your strand:</label><br>
            <select id="strand" name="strand" required>
                <option value="">Select Strand</option>
                <?php foreach($strands as $strand): ?>
                    <option value="<?php echo $strand['strand_id']; ?>"><?php echo $strand['strand_name']; ?></option>
                <?php endforeach; ?>
            </select><br><br>
            <input type="submit" name="submit" value="Sign Up">
        </form>
    </div>
</body>
</html>
