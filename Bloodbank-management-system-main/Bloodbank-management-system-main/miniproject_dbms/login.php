<?php
require('config.php');
session_start();
// When form submitted, check and create user session.
if (isset($_POST['email'])) {
    $email = stripslashes($_REQUEST['email']);    // removes backslashes
    $email = mysqli_real_escape_string($con, $email);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);
    // Check user is exist in the database
    $query    = "SELECT * FROM `users` WHERE email='$email'
                     AND password='" . md5($password) . "'";
    $result = mysqli_query($con, $query);
    $rows = mysqli_num_rows($result);
    if ($rows >= 1) {
        $_SESSION['email'] = $email;
        // Redirect to user dashboard page
        header("Location: dashboard.php");
    } else {
        echo "<div class='form'>
                  <h3>Incorrect email/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>blood bank management</title>

    <!-- favicon -->
    <link href="favicons/favicon.ico" rel="icon" type="image/x-icon" />
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
    <!-- font awesome script -->
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" data-auto-a11y="true"></script>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bb-navbar">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">Blood Bank Management</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php#aboutus">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php#contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="bb-auth">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-12 col-lg-6 order-2 order-lg-1">
                    <div class="bb-card">
                        <div class="bb-card-header">
                            <h1 class="bb-title">Welcome back</h1>
                            <p class="bb-subtitle">Sign in to manage donors, recipients and requests.</p>
                        </div>
                        <form class="bb-form" method="post" name="login">
                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input id="email" type="text" class="form-control bb-input" name="email" placeholder="name@example.com" autofocus="true" required />
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="password">Password</label>
                                <input id="password" type="password" class="form-control bb-input" name="password" placeholder="Enter your password" required />
                            </div>

                            <button type="submit" value="Login" name="submit" class="btn btn-danger bb-button w-100">Login</button>
                            <p class="bb-link">New here? <a href="register.php">Create an account</a></p>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-lg-6 order-1 order-lg-2">
                    <div class="bb-hero">
                        <img class="bb-hero-img" src="images/blood4.jpg" alt="Blood donation">
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>

</html>