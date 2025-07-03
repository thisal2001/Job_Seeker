<?php

// This php code is responsible for making a vacancy verified

include("../../config/db.php");

session_start();


// Utils
function checkJobExists($jobId){
    global $conn;
    $jobId = mysqli_real_escape_string($conn, $jobId);
    $query = "SELECT * FROM `jobs` WHERE `jobId`='${jobId}'";
    $result = mysqli_query($conn, $query);

    // Job Check
    if(mysqli_num_rows($result) <= 0){
        return 0;
    }
    return 1;
}

function updateJobVerification($jobId){
    global $conn;
    $jobId = mysqli_real_escape_string($conn, $jobId);
    $query = "UPDATE `jobs` SET `jobVerified`='1' WHERE `jobId`='${jobId}'";

    if(mysqli_query($conn, $query)){
        return 1;       // Query executed successfully
    }
    return 0;           // Query execution failed
}
// Utils End


if(isset($_GET['jobId'])){

    if( !isset($_SESSION['role']) || $_SESSION['role'] != "admin" ){
        echo "<script>alert('Unauthorized. Your not the admin user.'); window.location.href='/jobseeker/';</script>";
    }

    $isJobExisting = checkJobExists($_GET['jobId']);
    if(!$isJobExisting){
        echo "<script>alert('Job vacancy not found.'); window.location.href='/jobseeker/';</script>";
    }

    // Update job to verified
    if(!updateJobVerification($_GET['jobId'])){
        header('Location: /jobseeker/pages/admin/manage-jobs.php?msg=Failed%20to%20update%20record.');
    }
    
    header('Location: /jobseeker/pages/admin/manage-jobs.php?msg=Job%20verified%20successfully.');

}