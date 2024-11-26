<?php

session_start();

$userID = $_SESSION['userID'];

include('connect.php');

$getdataquery = "SELECT provinces.provinceName,cities.cityName, users.userName, users.password, userinfo.firstName, userinfo.lastName, userinfo.birthDay 
FROM users LEFT JOIN userinfo ON users.userID = userinfo.userID 
LEFT JOIN addresses ON userinfo.addressID = addresses.addressID 
LEFT JOIN cities ON addresses.cityID = cities.cityID 
LEFT JOIN provinces ON addresses.provinceID = provinces.provinceID 
WHERE users.userID = $userID;";

$result = executeQuery($getdataquery); 

if (isset($_POST ['saveButton'])){
    $userName = $_POST ['userName'];
    $firstName = $_POST ['firstName'];
    $lastName = $_POST ['lastName'];
    $password = $_POST ['password'];
    $birthDay = $_POST ['birthDay'];

    $savequery = "UPDATE users 
    JOIN userinfo ON users.userID = userinfo.userID 
    SET 
    users.userName ='$userName',
    userinfo.firstName ='$firstName',
    userinfo.lastName ='$lastName',
    users.password ='$password',
    userinfo.birthDay ='$birthDay'
    WHERE users.userID = $userID";

    executeQuery($savequery);
    header ("Location: profile.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Acocunt</title>
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
                <a href="profile.php"> <button on-click type="button" class="btn custom-btn btn-lg button"
                        style="background-color: #FFA5F3; color: #4540A2; width: 100px;">
                        Back </button>
                </a>
            </nav>
        </div>
    </nav>

    <!-- Profile -->
    <!-- Register Text-->
   <div class="container-fluid" style="background-color: #4540A2; height:80vh; border-radius: 30px 30px 0 0;">

        <div class="row">
            <div class="col-12" style="padding-left: 100px;">
                <p class="edit" style="font-family: League Spartan, sans-serif;  font-style: normal;  color: #FFA5F3; font-size: 50px; padding-top: 30px; font-weight: 600;"> Edit Account</p>
            </div>

            <!-- User Register -->

            <?php
        if (mysqli_num_rows($result) > 0) {
            while ($user = mysqli_fetch_assoc($result)) {
        ?>

            <form method="post">
            <div class="row">

                <div class="col-12 col-sm-12 col-md-6 col-xl-6">

                    <div class="row p-3 justify-content-end align-items-end">
                        <input class 
                            value="<?php echo $user['userName']?>"
                            style="border-color: #ffffff; border-style: solid; border-radius: 5px; height: 60px; width: 500px;"
                            type="text" name="userName" placeholder="Username" required>
                    </div>

                    <div class="row p-3 justify-content-end align-items-end">
                        <input class
                            value="<?php echo $user['firstName']?>"
                            style="border-color: #ffffff; border-style: solid; border-radius: 5px; height: 60px; width: 500px;"
                            type="text" name="firstName" placeholder="First Name" required>
                    </div>

                    <div class="row p-3 justify-content-end align-items-end">
                        <input class
                            value="<?php echo $user['lastName']?>"
                            style="border-color: #ffffff; border-style: solid; border-radius: 5px; height: 60px; width: 500px;"
                            type="text" name="lastName" placeholder="Last Name" required>
                    </div>

                </div>

                <div class="col-12 col-sm-12 col-md-6 col-xl-6">

                    <div class="row p-3">
                        <input class
                            value="<?php echo $user['password']?>"
                            style="border-color: #ffffff; border-style: solid; border-radius: 5px; height: 60px; width: 500px;"
                            type="text" name="password" placeholder="Password" required>
                    </div>

                    <div class="row p-3">
                        <input class
                            value="<?php echo $user['birthDay']?>"
                            style="border-color: #ffffff; border-style: solid; border-radius: 5px; height: 60px; width: 500px;"
                            type="text" name="birthDay" placeholder="Birthday (y-m-d)" required>
                    </div>

                </div>

                <?php
             }
          }
        ?>

                <div class="row saveButton p-5" style="text-align: end;">
                    <a href="index.php"> <button on-click type="submit" class="btn custom-btn btn-lg"
                            style="background-color: #FFA5F3; color: #4540A2; width: 200px; height: 60px;" name="saveButton">
                            Save Changes </button>
                    </a>
                </div>

            </div>
            </form>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>