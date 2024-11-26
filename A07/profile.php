<?php

session_start();

$userpfp = $_SESSION['userpfp'];
$userID = $_SESSION['userID'];

if (!isset($_SESSION['userName'])) {
    header("Location: index.php");
  }

include('connect.php');

$getdataquery = "SELECT provinces.provinceName,cities.cityName, users.userName, userinfo.firstName, userinfo.lastName, userinfo.birthDay 
FROM users LEFT JOIN userinfo ON users.userID = userinfo.userID 
LEFT JOIN addresses ON userinfo.addressID = addresses.addressID 
LEFT JOIN cities ON addresses.cityID = cities.cityID 
LEFT JOIN provinces ON addresses.provinceID = provinces.provinceID 
WHERE users.userID = $userID;";

$result = executeQuery($getdataquery); 

if (isset($_POST ['deleteButton'])){

    $deletequery = "UPDATE `users` SET `isDeleted` = 'yes' WHERE `users`.`userID` = $userID;";
    executeQuery($deletequery);
    header ("Location: index.php");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="images/logoS.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/valorant" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@300;400;500;600;700;800;900&family=League+Spartan:wght@100..900&display=swap"
        rel="stylesheet">

</head>

<body>
    <!-- Profile Page -->

    <!-- logo Image -->
    <nav class="navbar bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand ">
                <img src="images/minilogo.png" alt="logo" width="150" height="120">
            </a>
            <!-- Back to Login -->
            <nav class="nav-item">
                <a href="index.php"> <button on-click type="button" class="btn custom-btn btn-lg button"
                        style="background-color: #FFA5F3; color: #4540A2; width: 100px;">
                        Logout </button>
                </a>
            </nav>
        </div>
    </nav>

    <!-- Profile -->
    <?php
        if (mysqli_num_rows($result) > 0) {
            while ($user = mysqli_fetch_assoc($result)) {
        ?>

    <div class="container-fluid" style="background-color: #4540A2; height: 100%; border-radius: 30px 30px 0 0;">

        <div class="row">
            <div class="col-8 col-sm-8 col-md-4 col-xl-2" style="text-align: left;">
                <h1 class="profile"> Profile</h1>
            </div>

            <div class="col-8 col-sm-8 col-md-4 col-xl-5" style="text-align: left;">
                <p class="username">
                    <?php echo $user['userName']?>
                </p>
            </div>

            <div class="col-4 col-sm-4 col-md-4 col-xl-5" style="text-align: right;">
                <img src="images/<?php echo $userpfp?>" class="img-fluid pfp" alt="logo" width="180" height="120">
            </div>
        </div>

        <!-- User Information -->
        <div class="row">


            <div class="col-12 col-sm-12 col-md-6 col-xl-6" style="text-align: left;">
                <p class="firstName"> First Name:
                    <?php echo $user['firstName']?>
                </p>
            </div>

            <div class="col-12 col-sm-12 col-md-6 col-xl-6" style="text-align: left;">
                <p class="lastName"> Last Name:
                    <?php echo $user['lastName']?>
                </p>
            </div>

        </div>


        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-xl-6" style="text-align: left;">
                <p class="birthDay"> Birthday:
                    <?php echo $user['birthDay']?>
                </p>
            </div>

            <div class="col-12 col-sm-12 col-md-6 col-xl-6" style="text-align: left;">
                <p class="address"> Address:
                    <?php echo $user['cityName']?>,
                    <?php echo $user['provinceName']?>
                </p>
            </div>
        </div>
        <?php
             }
          }
        ?>

        <!-- Edit Button -->
        <div class="row p-5 profileButton" style="text-align: right;">

            <div class="col-12 col-sm-12 col-md-6 col-xl-6 p-2" style="text-align: center;">
                <a href="editAccount.php"> <button on-click type="submit" name="editButton" class="btn custom-btn btn-lg"
                        style="background-color: #FFA5F3; color: #4540A2; height: 70px;">
                        Edit Account </button>
                </a>
            </div>

            <!-- Delete Button -->
            <div class="col-12 col-sm-12 col-md-6 col-xl-6 p-2" style="text-align: center;">

                <form method="post">
                    <a href="index.php"> <button on-click type="submit" name="deleteButton"
                            class="btn custom-btn btn-lg"
                            style="background-color: #ffffff; color: #ff0000; height: 70px;">
                            Delete Account </button>
                    </a>
                </form>
            </div>

        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>