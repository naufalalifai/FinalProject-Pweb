<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `appointment` WHERE id = '$delete_id'") or die('query failed');
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

    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
</head>

<body>

    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
        }
    }
    ?>
    <header class="header fixed-top">

        <div class="container">

            <div class="row align-items-center justify-content-between">

                <a href="logged_index.php#home" class="logo">Klinik<span>NARRAYA</span></a>

                <nav class="nav">
                    <a href="logged_index.php#home">home</a>
                    <a href="logged_index.php#about">about us</a>
                    <a href="logged_index.php#services">services</a>
                    <a href="logged_index.php#doctors">doctors</a>
                    <a href="logged_index.php#reviews">reviews</a>
                    <a href="logged_index.php#gallery">gallery</a>
                    <a href="seeappointment.php">my appointment</a>
                </nav>

                <div class="icons">
                    <div id="menu-btn" class="fas fa-bars"></div>
                    <div id="user-btn" class="fas fa-user"></div>
                </div>

                <div class="account-box">
                    <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
                    <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
                    <a href="logout.php" class="delete-btn">logout</a>
                </div>

            </div>

        </div>

    </header>

    <section class="appointment">

        <h1 class="heading">my appointment</h1>

        <div class="box-container">
            <?php
            $select_appointments = mysqli_query($conn, "SELECT * FROM `appointment` WHERE user_id = '$user_id'") or die('query failed');
            if (mysqli_num_rows($select_appointments) > 0) {
                while ($fetch_appointments = mysqli_fetch_assoc($select_appointments)) {
            ?>
                    <div class="box">
                        <p> name : <span><?php echo $fetch_appointments['name']; ?></span> </p>
                        <p> email : <span><?php echo $fetch_appointments['email']; ?></span> </p>
                        <p> number : <span><?php echo $fetch_appointments['number']; ?></span> </p>
                        <p> date : <span><?php echo $fetch_appointments['date']; ?></span> </p>
                        <p> doctor : <span><?php echo $fetch_appointments['doctor']; ?></span> </p>
                        <p> status : <span><?php echo $fetch_appointments['status']; ?></span> </p>
                        <form action="" method="post">
                            <input type="hidden" name="appointment_id" value="<?php echo $fetch_appointments['id']; ?>">
                            <a href="seeappointment.php?delete=<?php echo $fetch_appointments['id']; ?>" onclick="return confirm('delete this appointment?');" class="delete-btn">delete</a>
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

    <section class="footer">

        <div class="box-container container">

            <div class="box">
                <h3>contact info</h3>
                <p> <i class="fas fa-phone"></i> (0271) 999999 </p>
                <p> <i class="fab fa-whatsapp"></i> 081999999999 </p>
                <p> <i class="fas fa-envelope"></i> clinicnarraya@gmail.com </p>
                <p> <i class="fas fa-map-marker-alt"></i> solo, indonesia - 57155 </p>
            </div>


            <div class="box">

                <h3>opening hours</h3>
                <p> <i class="fas fa-clock"></i> 10:00am to 18:00pm </p>
            </div>

            <div class="box">
                <h3>follow us</h3>
                <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
                <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
                <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
                <a href="#"> <i class="fab fa-youtube"></i> youtube </a>
            </div>

        </div>

        <div class="credit"> &copy; copyright @
            <?php echo date('Y'); ?> by <span>Naufal Alif</span>
        </div>

    </section>



    <!-- custom js file link  -->
    <script src="js/script.js"></script>
</body>

</html>