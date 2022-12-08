<?php

$conn = mysqli_connect('localhost', 'root', '', 'klinikfp') or die('connection failed');

if (isset($_POST['cancel'])) {
    $cancel_id = $_POST['cancel'];
    mysqli_query($conn, "DELETE FROM `appointment` WHERE id = '$cancel_id'") or die('query failed');
    header('location:seeappointment.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik NARRAYA</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <!-- bootstrap cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">

    <!-- css file link  -->

    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>

<body>
    <header class="header fixed-top">

        <div class="container">

            <div class="row align-items-center justify-content-between">

                <a href="index.php#home" class="logo">Klinik<span>NARRAYA</span></a>

                <nav class="nav">
                    <a href="index.php#home">home</a>
                    <a href="index.php#about">about us</a>
                    <a href="index.php#services">services</a>
                    <a href="index.php#doctors">doctors</a>
                    <a href="index.php#gallery">gallery</a>
                    <a href="index.php#reviews">reviews</a>
                    <a href="seeappointment.php">my appointment</a>
                </nav>

                <a href="index.php#contact" class="link-btn">make appointment</a>

                <div id="menu-btn" class="fas fa-bars"></div>

            </div>

        </div>

    </header>

    <section class="appointment">

        <h1 class="heading">Appointment</h1>

        <div class="box-container">
            <?php
            $select_appointments = mysqli_query($conn, "SELECT * FROM `appointment`") or die('query failed');
            if (mysqli_num_rows($select_appointments) > 0) {
                while ($fetch_appointments = mysqli_fetch_assoc($select_appointments)) {
            ?>
                    <div class="box">
                        <p> name : <span><?php echo $fetch_appointments['name']; ?></span> </p>
                        <p> email : <span><?php echo $fetch_appointments['email']; ?></span> </p>
                        <p> number : <span><?php echo $fetch_appointments['number']; ?></span> </p>
                        <p> date : <span><?php echo $fetch_appointments['date']; ?></span> </p>
                        <p> doctor : <span><?php echo $fetch_appointments['doctor']; ?></span> </p>

                    </div>
            <?php
                }
            }
            ?>

        </div>

    </section>



    <!-- custom js file link  -->
    <script src="script.js"></script>
</body>

</html>