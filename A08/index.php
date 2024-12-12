<?php

include("connect.php");

$getquery = "SELECT flightNumber, departureAirportCode, arrivalAirportCode, departureDatetime, arrivalDatetime, airlineName, passengerCount, pilotName FROM `flightlogs`";


$departurequery = "SELECT DISTINCT departureAirportCode FROM `flightlogs` ORDER BY departureAirportCode ASC;";
$departureresult = executeQuery($departurequery);

$airlinequery = "SELECT DISTINCT airlineName FROM `flightlogs` ORDER BY airlineName ASC;";
$airlineresult = executeQuery($airlinequery);

$pilotquery = "SELECT DISTINCT pilotName FROM `flightlogs` ORDER BY pilotName ASC;";
$pilotresult = executeQuery($pilotquery);

if (isset($_GET['sortButton'])) {

    $departurefilter = $_GET['departureAirportCode'];
    $airlinefilter = $_GET['airlineName'];
    $pilotfilter = $_GET['pilotName'];

    if ($departurefilter != '' || $airlinefilter != '' || $pilotfilter != '') {

        $getquery = $getquery . ' WHERE';

        if ($departurefilter != '') {
            $getquery = $getquery . " departureAirportCode = '$departurefilter'";
        }

        if ($departurefilter != '' && $airlinefilter != '') {
            $getquery = $getquery.' AND';
        }

        if ($airlinefilter != '') {
            $getquery = $getquery . " airlineName = '$airlinefilter'";
        }

        if ($departurefilter != '' && $airlinefilter != '' && $pilotfilter != '') {
            $getquery = $getquery.' AND';
        }

        if ($pilotfilter != '') {
            $getquery = $getquery . " pilotName = '$pilotfilter'";
            
        }
    }
}
$result = executeQuery($getquery);
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PUP Airport</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="imgs/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/valorant" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Anonymous+Pro:ital,wght@0,400;0,700;1,400;1,700&family=Baskervville+SC&family=Baskervville:ital@0;1&family=Castoro+Titling&family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&family=Inknut+Antiqua:wght@300;400;500;600;700;800;900&family=League+Spartan:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Simonetta:ital,wght@0,400;0,900;1,400;1,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/segoe-ui-4" rel="stylesheet">

</head>

<style>
    body {
        background-color: #EBD45D;
    }

    .empName {
        font-size: 55px;
        font-family: "Crimson Text", serif;
        font-weight: 400;
        font-style: normal;
        color: #A10D0D;
        text-align: center;
    }

    .occupation {
        font-size: 20px;
        font-family: 'Segoe UI', sans-serif;
        font-weight: 64;
        font-style: normal;
        color: #000000;
    }

    .contentBody {
        background-color: #f5f5f5;
        border-radius: 30px 30px 0 0;
    }

    .flightLabel {
        font-size: 50px;
        font-family: "Crimson Text", serif;
        font-weight: 700;
        font-style: normal;
        color: #A10D0D;
        text-align: center;
        padding-top: 20px;
    }

    .sortContainer {
        background-color: #D4D4D4;
        border-radius: 20px 20px 20px 20px;
    }

    .sort {
        font-size: 25px;
        font-family: "Crimson Text", serif;
        font-weight: 400;
        font-style: normal;
        color: #000000;
        padding-top: 23px;
    }

    .tableRow {
        text-align: center;
    }

    .table {
        font-family: "Crimson Text", serif;
    }
</style>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg" style="background-color: #EBD45D;">
        <!-- Logo -->
        <div class="container d-flex justify-content-between">
            <a class="navbar-brand">
                <img src="imgs/LogoNav.png" alt="logo" width="120" height="120">
            </a>

            <!-- Employee Name -->
            <nav class="nav-item">
                <div class="row">
                    <p class="empName">Cassy Austin</p>
                </div>

                <div class="row" style="text-align: center;">
                    <p class="occupation">Flight Attendant</p>
                </div>
            </nav>

            <!-- Search Bar -->
            <nav class="nav-item">
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search in this table"
                        aria-label="Search">
                    <button class="btn-custom-btn" type="submit"
                        style="background-color:#A10D0D; color: white;">Search</button>
                </form>
            </nav>
        </div>
    </nav>

    <!-- Start of Contents -->
    <div class="container-fluid contentBody">

        <!-- Flight Logs Name -->
        <div class="row p-4">
            <div class="col-12 col-sm-12 col-md-3 col-xl-4">
                <p class="flightLabel">Flight Logs</p>
            </div>

            <!-- Sorting Section -->
            <div class="col-12 col-sm-12 col-md-9 col-xl-8">

                <form>
                    <div class="container sortContainer">
                        <div class="row">

                            <div
                                class="col-12 col-sm-12 col-md-3 col-xl-3 d-flex justify-content-center align-items-center p-4">
                                <p class="sort">Sort by:</p>
                            </div>

                            <div
                                class="col-12 col-sm-12 col-md-2 col-xl-2 d-flex justify-content-center align-items-center p-4">
                                <select name="departureAirportCode" id="deptCode" style="width: 200px;">

                                    <option selected value="">Departure Code</option>

                                    <?php
                                    while ($departurecode = mysqli_fetch_array($departureresult)) {
                                        ?>

                                        <option value="<?php echo $departurecode['departureAirportCode'] ?>"><?php echo $departurecode['departureAirportCode'] ?></option>

                                        <?php
                                    }
                                    ?>

                                </select>
                            </div>

                            <div
                                class="col-12 col-sm-12 col-md-2 col-xl-2 d-flex justify-content-center align-items-center p-4">
                                <select name="airlineName" id="airlineName" style="width: 200px;">

                                    <option selected value="">Airline Name</option>

                                    <?php
                                    while ($airlineName = mysqli_fetch_array($airlineresult)) {
                                        ?>
                                        <option value="<?php echo $airlineName['airlineName'] ?>"><?php echo $airlineName['airlineName'] ?></option>
                                        <?php
                                    }
                                    ?>

                                </select>
                            </div>

                            <div
                                class="col-12 col-sm-12 col-md-3 col-xl-3 d-flex justify-content-center align-items-center p-4">
                                <select name="pilotName" id="pilotName" style="width: 200px;">

                                    <option selected value="">Pilot Name</option>

                                    <?php
                                    while ($pilotName = mysqli_fetch_array($pilotresult)) {
                                        ?>

                                        <option value="<?php echo $pilotName['pilotName'] ?>"><?php echo $pilotName['pilotName'] ?></option>

                                        <?php
                                    }
                                    ?>

                                </select>
                            </div>

                            <div
                                class="col-12 col-sm-12 col-md-2 col-xl-2 d-flex justify-content-center align-items-center p-4">
                                <button class="btn-custom-btn" name="sortButton" type="submit"
                                    style="background-color:#A10D0D; color: white;">Sort</button>
                            </div>

                        </div>
                    </div>
                </form>

            </div>

        </div>


        <div class="row tableRow">

            <div class="table-responsive-sm">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Flight Number</th>
                            <th scope="col">Departure Code</th>
                            <th scope="col">Arrival Code</th>
                            <th scope="col">Departure D/T</th>
                            <th scope="col">Arrival D/T</th>
                            <th scope="col">Airline Name</th>
                            <th scope="col">Passenger Count</th>
                            <th scope="col">Pilot Name</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        while ($flightlogsdata = mysqli_fetch_array($result)) {
                            ?>
                            <tr style="font-family: 'Segoe UI', sans-serif;">
                                <td class="flightNo."><?php echo $flightlogsdata['flightNumber'] ?></td>
                                <td class="departureCode"><?php echo $flightlogsdata['departureAirportCode'] ?></td>
                                <td class="arrivalCode"><?php echo $flightlogsdata['arrivalAirportCode'] ?></td>
                                <td class="Departure D/T"><?php echo $flightlogsdata['departureDatetime'] ?></td>
                                <td class="Arrival D/T"><?php echo $flightlogsdata['arrivalDatetime'] ?></td>
                                <td class="Airline Name"><?php echo $flightlogsdata['airlineName'] ?></td>
                                <td class="Passenger Count"><?php echo $flightlogsdata['passengerCount'] ?></td>
                                <td class="Pilot Name"><?php echo $flightlogsdata['pilotName'] ?></td>
                            </tr>
                            <?php
                        }
                        ?>

                    </tbody>

                </table>
            </div>

        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>