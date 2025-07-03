<?php

    session_start();

    include("../../config/db.php");
    define('BASE_URL', "/jobseeker");
    define('CURRENT_PAGE', "jobs");

    $verifiedJobs;

    // Util Functions
    function getVerifiedJobs(){
        global $conn;

        $query = "  SELECT j.jobId,j.title,j.type,j.location,j.company, r.profilePicPath
                    FROM `jobs` j INNER JOIN `recruiter` r ON j.recId = r.recId
                    WHERE `jobVerified`='1'
                ";

        $result = mysqli_query($conn, $query);
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $result;
    }
    // Util Functions

    function main(){
        global $verifiedJobs;
        $verifiedJobs = getVerifiedJobs();
    }

    main();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobSeeker - Browse Jobs</title>

    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/global.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/responsive.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/pages/jobs.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/navbar.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/footer.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/buttons.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/cards.css">

    

</head>
<body>

    <?php include "../../assets/includes/navs/nav-common.php" ?>
    <?php include "../../assets/includes/navs/nav-candidate.php" ?>
    <?php include "../../assets/includes/navs/nav-recruiter.php" ?>
    <?php include "../../assets/includes/navs/nav-admin.php" ?>

    <main id="container">
        <br>

        <h1 class="text-center my-4">Job Listing</h1>
        <hr class="underliner">

        <br><br>

        <div id="cards-container">

            <?php foreach ($verifiedJobs as $row) { ?>
                <div class="card">
                    <div class="card-wrapper flex flex-col md:flex-row md:max-w-xl rounded-lg bg-white shadow-lg">
                        <img class="card-img w-full h-96 md:h-auto object-cover md:w-48 rounded-t-lg md:rounded-none md:rounded-l-lg" src="<?php echo $row['profilePicPath']; ?>" alt="" />
                        <div class="card-content p-6 flex flex-col justify-start">
                            <div class="left">
                                <h5 class="card-title"><?php echo $row['title']; ?></h5>
                                <p class="card-job-type"><?php echo $row['type']; ?></p>
                                <p class="card-company"><?php echo $row['company']; ?></p>
                            </div>
                            <div class="right">
                                <div class="card-location-wrapper">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="map-icon"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                                    <p class="card-location"><?php echo $row['location']; ?></p>
                                </div>
                                <a href="<?php echo BASE_URL?>/pages/jobs/view-job.php?jobId=<?php echo $row['jobId']; ?>" class="apply-btn btn button-outline mx-4">View</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if(count($verifiedJobs) <= 0){ ?>
                <img class="icon-sm d-block mx-auto" src="<?php echo BASE_URL?>/assets/svg/box-empty.svg" alt="Empty Icon">
                <h3 class="text-center">No Jobs Found. Be the first to post a job vacancy.</h3>
            <?php } ?>

        </div>

        <br><br>
    </main>

    <?php include '../../assets/includes/footer.php' ?>
    
    <script src="<?php echo BASE_URL?>/assets/js/navbar.js"></script>

</body>
</html>