<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}

if (isset($_POST['update_appointment'])) {

    $appointment_update_id = $_POST['appointment_id'];
    $update_status = $_POST['update_status'];
    mysqli_query($conn, "UPDATE `appointment` SET status = '$update_status' WHERE id = '$appointment_update_id'") or die('query failed');
    $message[] = 'appointment status has been updated!';
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `appointment` WHERE id = '$delete_id'") or die('query failed');
    header('location:admin_appointment.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Appointment</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/admin_style.css?v=<?php echo time(); ?>">

</head>

<body>

    <?php include 'admin_header.php'; ?>

    <section class="appointments">

        <h1 class="title">appointments</h1>

        <div class="box-container">
            <?php
            $select_appointments = mysqli_query($conn, "SELECT * FROM `appointment`") or die('query failed');
            if (mysqli_num_rows($select_appointments) > 0) {
                while ($fetch_appointments = mysqli_fetch_assoc($select_appointments)) {
            ?>
                    <div class="box">
                        <p> user id : <span><?php echo $fetch_appointments['user_id']; ?></span> </p>
                        <p> name : <span><?php echo $fetch_appointments['name']; ?></span> </p>
                        <p> email : <span><?php echo $fetch_appointments['email']; ?></span> </p>
                        <p> number : <span><?php echo $fetch_appointments['number']; ?></span> </p>
                        <p> date : <span><?php echo $fetch_appointments['date']; ?></span> </p>
                        <p> doctor : <span><?php echo $fetch_appointments['doctor']; ?></span> </p>
                        <form action="" method="post">
                            <input type="hidden" name="appointment_id" value="<?php echo $fetch_appointments['id']; ?>">
                            <select name="update_status">
                                <option value="" selected disabled><?php echo $fetch_appointments['status']; ?></option>
                                <option value="scheduled">scheduled</option>
                                <option value="done">done</option>
                            </select>
                            <input type="submit" value="update" name="update_appointment" class="option-btn">
                            <a href="admin_appointment.php?delete=<?php echo $fetch_appointments['id']; ?>" onclick="return confirm('delete this appointment?');" class="delete-btn">delete</a>
                        </form>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">no appointment yet!</p>';
            }
            ?>
        </div>

    </section>














    <!-- custom admin js file link  -->
    <script src="js/admin_script.js"></script>

</body>

</html>