<?php

    session_start();

    // Only candidate can apply for vancancy.
    if(!isset($_SESSION['role']) || $_SESSION['role'] != "candidate" ){
        $jobId = $_GET['jobId'];
        header("Location: /jobseeker/pages/jobs/view-job.php?jobId=${jobId}&msg=You%20need%20to%20have%20a%20job%20candidate%20account%20to%20apply%20for%20job%20vacancies.%20Please%20login%20as%20a%20job%20candidate.");
    }

    define('BASE_URL', "/jobseeker");
    define('CURRENT_PAGE', "dashboard");

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>JobSeeker - Applied for job</title>

<link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/global.css">
<link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/responsive.css">
<link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/pages/admin-manage-recruiters.css">
<link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/navbar.css">
<link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/footer.css">
<link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/buttons.css">
<link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/cards.css">



<style>
    #container{
        width: 80%;
        display: block;
        margin: 0px auto;
    }
    #job-details{
        background-color: #ffe7d3;
        padding: 20px;
        border: 1px solid #ffa052;

    }
    a.btn{
        font-weight: 500;
        text-align: center;
        text-decoration: none;
        color: inherit;
    }
</style>

</head>
<body>

<?php include "../../assets/includes/navs/nav-common.php" ?>
<?php include "../../assets/includes/navs/nav-candidate.php" ?>

<main id="container">
    <br>
    
    <h1 class="text-center my-4">Applied Successfully</h1>
    <hr class="underliner">

    <br><br>

    <div id="job-details">
        <p class="text-center">🎉 Congrats you have successfully applied for this job vacancy. 🎉</p>
    </div>

    <br><br><br><br>



</main>

<?php include '../../assets/includes/footer.php' ?>

<script src="<?php echo BASE_URL?>/assets/js/navbar.js"></script>

</body>
</html>