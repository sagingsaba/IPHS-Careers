
<?php
session_start();
require_once "include\connect\dbcon.php";
// try {
   
    
//     if(isset($_POST["submit"])){
//         if(empty($_POST['email']) || empty($_POST['pass'])){
//             $message = "Please provide both your username and password for login";
//         }
//         else{
//             $email = $_POST['email'];
//             $pass = $_POST['pass'];

//             $sql = "SELECT * FROM user WHERE email = ?";
//             $stmt = $pdoConnect->prepare($sql);
//             $stmt->execute([$email]);
//             $row = $stmt->fetch(PDO::FETCH_ASSOC);

//             if ($stmt->rowCount()>0) {
//                 if($row && password_verify($_POST['pass'], $row['password'])){
//                     $_SESSION['fname'] = $row['fname'];
//                     $_SESSION['user_id'] = $row['user_id'];
    
//                     $role = $row['role'];
                    
    
//                     $timestamp = date('Y-m-d H:i:s');
//                     $sql = "INSERT INTO `log`(`action`, `timestamp`, `user_id`) VALUES (?,?,?)";
//                     $stmt = $pdoConnect->prepare($sql);
//                     $stmt->execute(["logged in",$timestamp,$row['user_id']]);
    
//                     if ($role == 'admin' || $role == 'Admin') {
//                         header("Location: admin_side\admindashboard.php");
//                         exit;
//                     } else {
//                         header("Location: home.php");
//                         exit;
//                     }
//                 }else{
//                     $message = 'The username or password is incorrect';
//                 }
//             } else {
//                 $message = 'No account found.';
//             }
//         }
//     }
// } catch (PDOException $error) {
//     $message = $error->getMessage();
// }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="include\image\logo.png">
    <link rel="stylesheet" href="include\styles\globalstyles.css">
    <link rel="stylesheet" href="include\styles\animation.css">
    <script src=".include\js\globaljs.js"></script>
    <title>Log In</title>
</head>
<body>
    <nav><img src="" alt=""></nav>
    <label>iPHS Carrers</label>     <!-- font: EXO, gradian -->
    <div class="nav_btn">
    <a href="home.html">Home</a>
    <a href="about.html">About</a>
    <a href="services.html">Services</a>
    <a href="faqs.html">FAQs</a>
    <a href="contact.html">Contact Us</a>
</div>
</body>
</html>