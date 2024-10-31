<?php
include('connect.php');

$getdataquery = "SELECT provinces.provinceName,cities.cityName, users.userName, userinfo.firstName, userinfo.lastName, userinfo.birthDay 
FROM users LEFT JOIN userinfo ON users.userID = userinfo.userID 
LEFT JOIN addresses ON userinfo.addressID = addresses.addressID 
LEFT JOIN cities ON addresses.cityID = cities.cityID 
LEFT JOIN provinces ON addresses.provinceID = provinces.provinceID 
WHERE users.userID = 3;";

$result = executeQuery($getdataquery); 

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

    <!-- Navigation Bar -->
    <nav class="navbar bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand ">
                <img src="images/talksyB.png" alt="logo" width="180" height="120">
            </a>

            <nav class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <img src="images/more.png" alt="logo" width="100" height="70">
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <div class="mx-3" style="color: #4540A2; font-weight: 600;">Accounts</div>
                    </li>
                    <li><a class="dropdown-item" href="anyaprofile.php">Anya Forger</a></li>
                    <li><a class="dropdown-item" href="cassyprofile.php">Cassy Austin</a></li>
                    <li><a class="dropdown-item" href="leviprofile.php">Levi Ackerman</a></li>
                    <li><a class="dropdown-item" style="background-color: #FFA5F3; color: #ffff;" href="index.php">Go Back</a></li>
                </ul>
            </nav>
        </div>
    </nav>

    <!-- Profile -->
    <?php
        if (mysqli_num_rows($result) > 0) {
            while ($user = mysqli_fetch_assoc($result)) {
        ?>
    <div class="container-fluid" style="background-color: #4540A2; height: 85vh; border-radius: 30px 30px 0 0;">

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
                <img src="images/leviprofile.png" class="img-fluid pfp" alt="logo" width="180" height="120">
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

    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"> </script>
</body>

</html>