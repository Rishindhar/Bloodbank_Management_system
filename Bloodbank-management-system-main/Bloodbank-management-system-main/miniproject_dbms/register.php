<?php
require('config.php');
// When form submitted, insert values into the database.
if (isset($_REQUEST['name'])) {
    // removes backslashes
    $name = stripslashes($_REQUEST['name']);
    //escapes special characters in a string
    $name = mysqli_real_escape_string($con, $name);
    $email    = stripslashes($_REQUEST['email']);
    $email    = mysqli_real_escape_string($con, $email);
    $phone    = stripslashes($_REQUEST['phone']);
    $phone    = mysqli_real_escape_string($con, $phone);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);

    $query    = "INSERT into `users` (name , email, phone, password)
                     VALUES ('$name', '$email',  '$phone', '" . md5($password) . "')";
    $result   = mysqli_query($con, $query);
    if ($result) {
        echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
    } else {
        echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Registration</title>
    <link href="favicons/favicon.ico" rel="icon" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/register.css">
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
                            <h1 class="bb-title">Create your account</h1>
                            <p class="bb-subtitle">Register to submit donor/recipient details and request blood.</p>
                        </div>
                        <form class="bb-form" action="" method="post">
                            <div class="mb-3">
                                <label class="form-label" for="name">Name</label>
                                <input id="name" type="text" class="form-control bb-input" name="name" placeholder="Your name" required />
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input id="email" type="text" class="form-control bb-input" name="email" placeholder="name@example.com" required />
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="phone">Phone</label>
                                <input id="phone" type="text" class="form-control bb-input" name="phone" placeholder="10-digit number" required />
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="password">Password</label>
                                <input id="password" type="password" class="form-control bb-input" name="password" placeholder="Create a password" required />
                            </div>

                            <button type="submit" name="submit" value="Register" class="btn btn-danger bb-button w-100">Create account</button>
                            <p class="bb-link">Already have an account? <a href="login.php">Login</a></p>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-lg-6 order-1 order-lg-2">
                    <div class="bb-hero">
                        <img class="bb-hero-img" src="images/blood3.jpg" alt="Blood donation">
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>