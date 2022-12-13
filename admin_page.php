<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/admin_style.css?v=<?php echo time(); ?>">

</head>

<body>

    <?php include 'admin_header.php'; ?>


    <section class="dashboard">

        <h1 class="title">dashboard</h1>

        <div class="box-container">

            <div class="box">
                <?php
                $select_scheduled = mysqli_query($conn, "SELECT status FROM `appointment` WHERE status = 'scheduled'") or die('query failed');
                $number_of_scheduled = mysqli_num_rows($select_scheduled);
                ?>
                <h3><?php echo $number_of_scheduled; ?></h3>
                <p>scheduled appointment</p>
            </div>

            <div class="box">
                <?php
                $select_appointments = mysqli_query($conn, "SELECT * FROM `appointment`") or die('query failed');
                $number_of_appointment = mysqli_num_rows($select_appointments);
                ?>
                <h3><?php echo $number_of_appointment; ?></h3>
                <p>total appointment</p>
            </div>

            <div class="box">
                <?php
                $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('query failed');
                $number_of_users = mysqli_num_rows($select_users);
                ?>
                <h3><?php echo $number_of_users; ?></h3>
                <p>normal users</p>
            </div>

            <div class="box">
                <?php
                $select_admins = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('query failed');
                $number_of_admins = mysqli_num_rows($select_admins);
                ?>
                <h3><?php echo $number_of_admins; ?></h3>
                <p>admin users</p>
            </div>

        </div>

    </section>











    <!-- custom admin js file link  -->
    <script src="js/admin_script.js"></script>

</body>

</html>