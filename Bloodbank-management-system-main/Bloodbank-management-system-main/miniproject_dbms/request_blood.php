<?php
require('config.php');
// When form submitted, insert values into the database.
$action = isset($_GET['action']) ? $_GET['action'] : '';
if ($action === 'lookup' && isset($_GET['reci_id'])) {
    $reci_id  = stripslashes($_GET['reci_id']);
    $reci_id  = mysqli_real_escape_string($con, $reci_id);
    $lookup = mysqli_query($con, "SELECT reci_name FROM recipient WHERE reci_id='$reci_id' LIMIT 1");
    $name = '';
    if ($lookup && mysqli_num_rows($lookup) > 0) {
        $row = mysqli_fetch_assoc($lookup);
        $name = $row['reci_name'];
    }
    header('Content-Type: application/json');
    echo json_encode(['name' => $name]);
    exit;
}

$prefill_name = '';
if (isset($_POST['reci_id'])) {
    $reci_id  = stripslashes($_POST['reci_id']);
    $reci_id  = mysqli_real_escape_string($con, $reci_id);
    $entered_name = isset($_POST['reci_name']) ? stripslashes($_POST['reci_name']) : '';
    $entered_name = mysqli_real_escape_string($con, $entered_name);

    $lookup = mysqli_query($con, "SELECT reci_name FROM recipient WHERE reci_id='$reci_id' LIMIT 1");
    if ($lookup && mysqli_num_rows($lookup) > 0) {
        $row = mysqli_fetch_assoc($lookup);
        $prefill_name = $row['reci_name'];
    }

    if (isset($_POST['submit_request'])) {
        $reci_bgrp   = stripslashes($_POST['reci_bgrp']);
        $reci_bgrp   = mysqli_real_escape_string($con, $reci_bgrp);

        if ($prefill_name === '') {
            echo "<div class='form'>
                      <h3>Recipient ID not found.</h3><br/>
                      <p class='link'>Click here to <a href='request_blood.php'>try again</a> with a valid recipient id.</p>
                      </div>";
            exit;
        }

        if ($entered_name !== '' && strcasecmp($entered_name, $prefill_name) !== 0) {
            echo "<div class='form'>
                      <h3>Recipient name does not match this recipient id.</h3><br/>
                      <p class='link'>Click here to <a href='request_blood.php'>try again</a>.</p>
                      </div>";
            exit;
        }

        $reci_name = mysqli_real_escape_string($con, $prefill_name);
        $has_bqnty = mysqli_query($con, "SELECT 1 FROM information_schema.COLUMNS WHERE TABLE_SCHEMA='" . DB_NAME . "' AND TABLE_NAME='blood_request' AND COLUMN_NAME='reci_bqnty' LIMIT 1");
        $use_bqnty = $has_bqnty && mysqli_num_rows($has_bqnty) > 0;

        if ($use_bqnty) {
            $reci_bqnty = 1;
            $query    = "INSERT into `blood_request` (reci_name, reci_bgrp, reci_bqnty, reci_id)
                             VALUES ('$reci_name', '$reci_bgrp', '$reci_bqnty', '$reci_id');";
        } else {
            $query    = "INSERT into `blood_request` (reci_name, reci_bgrp, reci_id)
                             VALUES ('$reci_name', '$reci_bgrp', '$reci_id');";
        }

        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                      <h3>Blood Request registered successfully.</h3><br/>
                      <p class='link'>Click here to <a href='dashboard.php'>Dashboard</a></p>
                      </div>";
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Recipient Details</title>
    <!-- favicon -->
    <link href="favicons/favicon.ico" rel="icon" type="image/x-icon" />
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/request_blood.css">
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
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
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


    <form class="form" action="" method="post">
        <h1 class="login-title">Blood request details</h1>
        <input id="reci_id" type="text" class="login-input" name="reci_id" placeholder="recipient id" required />
        <input id="reci_name" type="text" class="login-input" name="reci_name" placeholder="recipient name" value="<?php echo htmlspecialchars($prefill_name); ?>" />
        <input type="text" class="login-input" name="reci_bgrp" placeholder="recipient blood group" required />
        <input type="submit" name="submit_request" value="Submit" class="btn btn-dark btn-lg register-button">

    </form>

    <script>
        (function () {
            const idEl = document.getElementById('reci_id');
            const nameEl = document.getElementById('reci_name');
            if (!idEl || !nameEl) return;

            let lastValue = '';
            async function lookup() {
                const id = (idEl.value || '').trim();
                if (!id || id === lastValue) return;
                lastValue = id;
                nameEl.value = '';
                try {
                    const res = await fetch('request_blood.php?action=lookup&reci_id=' + encodeURIComponent(id), { cache: 'no-store' });
                    const data = await res.json();
                    nameEl.value = data && data.name ? data.name : '';
                } catch (e) {
                    nameEl.value = '';
                }
            }

            idEl.addEventListener('change', lookup);
            idEl.addEventListener('blur', lookup);
        })();
    </script>

</body>

</html>