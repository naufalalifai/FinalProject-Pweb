<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}


if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
    $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

    if (mysqli_num_rows($select_users) > 0) {
        $message[] = 'user already exist!';
    } else {
        if ($pass != $cpass) {
            $message[] = 'confirm password not matched!';
        } else {
            mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type) VALUES('$name', '$email', '$cpass', 'admin')") or die('query failed');
            $message[] = 'registered successfully!';
            header('location:admin_users.php');
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/admin_style.css?v=<?php echo time(); ?>">

</head>

<body>

    <?php include 'admin_header.php'; ?>

    <div class="form-container">

        <form action="" method="post">
            <h3>register admin</h3>
            <input type="text" name="name" placeholder="enter name" required class="box">
            <input type="email" name="email" placeholder="enter email" required class="box">
            <input type="password" name="password" placeholder="enter password" required class="box">
            <input type="password" name="cpassword" placeholder="confirm password" required class="box">
            <input type="submit" name="submit" value="register" class="btn">
        </form>

    </div>

    <!-- custom admin js file link  -->
    <script src="js/admin_script.js"></script>

</body>

</html>