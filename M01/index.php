<?php

session_start();
include("connect.php");



if (isset($_POST ['loginButton'])){
    $userName = $_POST ['userName'];
    $password = $_POST ['password'];



    $query = "SELECT * from users JOIN userinfo ON users.userID = userinfo.userID WHERE userName ='$userName' and password ='$password';";
    $result = executeQuery($query);

    if (mysqli_num_rows($result)>0){
        while($user = mysqli_fetch_assoc($result)){

            $_SESSION['firstName'] = $user['firstName'];
            $_SESSION['lastName'] = $user['lastName'];
            $_SESSION['userName'] = $user['userName'];
            $_SESSION['userID'] = $user['userID'];
            $_SESSION['userpfp'] = $user['userpfp'];

            header ("Location: profile.php");
        }
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talksy</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="images/logoS.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">


</head>

<body>

    <!-- Landing Page -->
    <div class="row pt-5" style="overflow-x: hidden;">

        <!-- Logo and Slogan -->
        <div class="col-12 col-sm-12 col-md-6 col-xl-6">
            <!-- Logo -->
            <div class="row" style="text-align: center;">
                <div class="container"> <img src="images/talksyB.png" class="img-fluid logo" alt="talksyLogo"> </div>
            </div>
            <!-- Slogan -->
            <div class="row slogan">
                <p>Talksy. Talk Anywhere, Anytime.</p>
            </div>
        </div>

        <!-- LogIn -->
        <div class="col-12 col-sm-12 col-md-6 col-xl-6 p-3 justify-content-center align-items-center">
            <div class="container log justify-content-center align-items-center"
                style="background-color: white; height: 420px; max-width: 425px; border-radius: 20px;">

                <!-- Login Text -->
                <div class="row login">
                    <p class="logText"
                        style="color: #4540A2; font-size: 40px; font-family: League Spartan, sans-serif; font-weight: 550;">
                        Log In </p>
                </div>

                <!-- Email -->
                <form method="post">
                    <div class="row p-2">
                        <input class
                            style="border-color: #4540A2; border-style: solid; border-radius: 5px; height: 50px;"
                            type="text" name="userName" placeholder="Username" required>
                    </div>

                    <!-- Password -->
                    <div class="row p-2">
                        <input class name="password" type="password" placeholder="Password" required
                            style="border-color: #4540A2; border-style: solid; border-radius: 5px; height: 50px;">
                    </div>

                    <!-- Buttons -->
                    <div class="row align-items-center p-3">

                        <!-- Login Button -->
                        <div class="col-12 col-sm-12 col-md-6 col-xl-6 p-1" style="text-align: center;">
                            <button name="loginButton" type="submit" class="btn custom-btn btn-lg button"
                                style="background-color: #4540A2; color: #ffff; width: 150px;">
                                Login </button>
                        </div>
                </form>

                <!-- Sign Up Button -->
                <div class="col-12 col-sm-12 col-md-6 col-xl-6 p-1" style="text-align: center;">
                    <a href="signin.php"> <button on-click type="button" class="btn custom-btn btn-lg button"
                            style="background-color: #FFA5F3; color: #4540A2;">
                            New Account </button>
                    </a>
                </div>
            </div>

        </div>
    </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>