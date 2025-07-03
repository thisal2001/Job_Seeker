<?php

// This php code is responsible for add a recruiter

include("../../config/db.php");

session_start();


// Utils
function checkRecruiterExists($recId){
    global $conn;
    $recId = mysqli_real_escape_string($conn, $recId);
    $query = "SELECT * FROM `recruiter` WHERE `recId`='${recId}'";
    $result = mysqli_query($conn, $query);

    // Username Check
    if(mysqli_num_rows($result) <= 0){
        return 0;
    }
    return 1;
}

function removeRecruiter($recId){
    global $conn;
    $recId = mysqli_real_escape_string($conn, $recId);
    $query = "DELETE FROM `recruiter` WHERE `recId`='${recId}'";
    $result = mysqli_query($conn, $query);

    if(mysqli_query($conn, $query)){
        return 1;       // Query executed successfully
    }
    return 0;           // Query execution failed
}

// Utils End

if(isset($_GET['recId'])){

    if( !isset($_SESSION['role']) || $_SESSION['role'] != "admin" ){
        echo "<script>alert('Unauthorized. Your not the admin user.'); window.location.href='/jobseeker/';</script>";
    }

    $isUserExisting = checkRecruiterExists($_GET['recId']);
    echo $isUserExisting;
    if(!$isUserExisting){
        echo "<script>alert('Recruiter not found.'); window.location.href='/jobseeker/';</script>";
    }

    // Update recruiter to verified
    if(!removeRecruiter($_GET['recId'])){
        header('Location: /jobseeker/pages/admin/manage-recruiters.php?msg=Failed%20to%20remove%20record.');
    }

    header('Location: /jobseeker/pages/admin/manage-recruiters.php?msg=Recruiter%20rejected%20successfully.');

}