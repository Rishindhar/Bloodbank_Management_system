<?php
require('config.php');
// When form submitted, insert values into the database.
if (isset($_REQUEST['D_name'])) {
    // removes backslashes
    $D_name = stripslashes($_REQUEST['D_name']);
    //escapes special characters in a string
    $D_name = mysqli_real_escape_string($con, $D_name);
    $D_age    = stripslashes($_REQUEST['D_age']);
    $D_age    = mysqli_real_escape_string($con, $D_age);
    $D_sex    = stripslashes($_REQUEST['D_sex']);
    $D_sex    = mysqli_real_escape_string($con, $D_sex);
    $D_phno    = stripslashes($_REQUEST['D_phno']);
    $D_phno    = mysqli_real_escape_string($con, $D_phno);
    $D_bgrp    = stripslashes($_REQUEST['D_bgrp']);
    $D_bgrp    = mysqli_real_escape_string($con, $D_bgrp);

    $existing = mysqli_query($con, "SELECT D_id FROM donor WHERE D_phno='$D_phno' LIMIT 1");
    if ($existing && mysqli_num_rows($existing) > 0) {
        echo "<div class='form'>
                  <h3>This phone number is already registered.</h3><br/>
               <p class='link'>Click here to <a href='donor_details.php'>try again</a> with a different phone number.</p>
                  </div>";
        exit;
    }

    $query    = "INSERT into `donor` (D_name, D_age, D_sex, D_phno, D_bgrp, rdate)
                     VALUES ('$D_name', '$D_age', '$D_sex', '$D_phno', '$D_bgrp', current_timestamp());";
    $result   = mysqli_query($con, $query);
    if ($result) {
        echo "<div class='form'>
                  <h3>Donor registered successfully.</h3><br/>
               <p class='link'>Click here to <a href='dashboard.php'>go to home page</a></p>
                  </div>";
    } else {
        echo "<div class='form'>
                  <h3>Unable to register donor.</h3><br/>
                  <p class='link'>Click here to <a href='donor_details.php'>try again</a>.</p>
                  </div>";
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Blood bank management</title>
    <!-- favicon -->
    <link href="favicons/favicon.ico" rel="icon" type="image/x-icon" />
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/donor_details.css">
    <!-- font awesome script -->
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" data-auto-a11y="true"></script>
</head>

<body>

    <div class="container-fluid">

        <nav class="navbar navbar-expand-lg navbar-dark">

            <a class="navbar-brand" href="">Blood bank management</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse nav_elements" id="navbarTogglerDemo02">

                <ul class="navbar-nav mx-auto">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
            
                    <li class="nav-item">
                        <a class="nav-link" href="#aboutus">About</a>
                    </li>

                </ul>
            </div>
        </nav>
    </div>


    <div class="donor_details">

        <form class="form" action="" method="post">
            <h1 class="Donor-title">Registration for donor</h1>
            <h4>
                <center>please enter the details of Donor below</center>
            </h4>
            <br>
            <label class="Donor-label" for="D_name">Full Name</label>
            <input id="D_name" type="text" class="Donor-input" name="D_name" placeholder="Enter full name" required />

            <label class="Donor-label" for="D_age">Age</label>
            <input id="D_age" type="number" class="Donor-input" name="D_age" placeholder="Enter age" required />

            <label class="Donor-label" for="D_sex">Sex</label>
            <input id="D_sex" type="text" class="Donor-input" name="D_sex" placeholder="Male / Female" required />

            <label class="Donor-label" for="D_phno">Phone Number</label>
            <input id="D_phno" type="text" class="Donor-input" name="D_phno" placeholder="10-digit phone number" required />

            <label class="Donor-label" for="D_bgrp">Blood Group</label>
            <input id="D_bgrp" type="text" class="Donor-input" name="D_bgrp" placeholder="A+ / O+ / B+ / AB+" required />
            <br>
            <br>
            <input type="submit" name="submit" value="Register" class=" btn btn-dark btn-lg Donor-button">

        </form>
    </div>



</body>

</html>

