<?php
    session_start();

    define('BASE_URL', "/jobseeker");
    define('CURRENT_PAGE', "register");

    // If already logged in. Redirect to spesific dashboard
    if(isset($_SESSION['role'])){
        header('Location: /jobseeker/pages/redirector.php');
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobSeeker - Register</title>

    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/global.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/responsive.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/pages/registration.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/navbar.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/footer.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/buttons.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/cards.css">

    

</head>
<body>

    <?php include "../../assets/includes/navs/nav-common.php" ?>

    <main id="container">
        <br>
        
        <h1 class="text-center my-4">Select Registration Option</h1>
        <hr class="underliner">

        <br>

        <div class="content-wrapper">
            <div class="col">
                <h1 class="text-center">Recruiter</h1>
                <img src="<?php echo BASE_URL?>/assets/svg/building.svg" alt="company icon">
                <p class="text-center">Are you a recruiter. Join with us and post your job vacancies at JobSeeker Platform.</p>
                <a href="<?php echo BASE_URL?>/pages/register/recruiter.php" class="d-flex justify-center">
                    <button class="btn button-filled">Register as a Recruiter</button>
                </a>
            </div>
            <div class="col2">
                <h1 class="text-center">Job Seeker</h1>
                <img src="<?php echo BASE_URL?>/assets/svg/employees.svg" alt="company icon">
                <p class="text-center">Are you looking for a job. Join with us and find your next dream job.</p>
                <a href="<?php echo BASE_URL?>/pages/register/candidate.php" class="d-flex justify-center">
                    <button class="btn button-filled">Register as a Job Candidate</button>
                </a>
            </div>
        </div>

        <br><br><br>
    </main>

    <?php include '../../assets/includes/footer.php' ?>
    
    <script src="<?php echo BASE_URL?>/assets/js/navbar.js"></script>

</body>
</html>