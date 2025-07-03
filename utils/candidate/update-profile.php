<?php
// This php code is responsible for updating candidate profile details

include("../../config/db.php");

session_start();

// Utils Functions
function checkFeilds(){

    $validationPass = 1;

    // Validate all paramaters exisiting
    if(!isset($_POST['name']) || 
    !isset($_POST['address'])||
    !isset($_POST['email'])||
    !isset($_POST['phone'])){
        echo "<script>alert('One or more feild are empty.')</script>";
        $validationPass = 0;
    }

    // Check for empty parameters
    if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['address']) || empty($_POST['phone'])){
        echo "<script>alert('One or more feilds are empty.')</script>";
        $validationPass = 0;
    }

    return $validationPass;

}

function auth($canId, $password){
    global $conn;

    $canId = mysqli_real_escape_string($conn, $canId);
    $query = "SELECT * FROM `candidate` WHERE `canId`='${canId}'";
    $result = mysqli_query($conn, $query);

    // User Avaliable Check
    if(mysqli_num_rows($result) <= 0){
        return 0;
    }

    $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $dbhash = $result[0]['hash'];

    // Password Check
    if(hash("sha512", $password) != $dbhash){
        return 0;
    }

    return 1;

}

function updateProfileData($canId, $name, $address, $phone, $email){
    global $conn;

    $canId = mysqli_real_escape_string($conn, $canId);
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $address = mysqli_real_escape_string($conn, $address);
    $phone = mysqli_real_escape_string($conn, $phone);

    $query = "UPDATE `candidate` SET `name`='${name}',`email`='${email}',`address`='${address}',`contactNo`='${phone}' WHERE `canId`='${canId}'";

    if(mysqli_query($conn, $query)){
        return 1;       // Query executed successfully
    }
    return 0;           // Query execution failed

}

function uploadCV(){
    if(empty($_FILES['cv-document']['name'])){
        // CV not uploaded
        return;
    }

    // Get file attributes
    $fileName = $_FILES['cv-document']['name'];
    $fileSize = $_FILES['cv-document']['size'];
    $fileTmp = $_FILES['cv-document']['tmp_name'];
    $targetDirectory = $_SERVER['DOCUMENT_ROOT'] . "/jobseeker/assets/uploads/cv-documents/${fileName}";
    $fileExt = strtolower(end(explode('.', $fileName)));
    $maxFileSize = 20 * 1024 * 1024;     // In Bytes

    // Check file type
    if($fileExt != "pdf"){
        header('Location: /jobseeker/pages/candidate/profile.php?msg=Only%20PDF%20files%20are%20allowed.');
        return;
    }

    // Check file size
    if($fileSize > $maxFileSize){
        header('Location: /jobseeker/pages/candidate/profile.php?msg=Maximum%20upload%20size%20is%2020%20MB');
        return;
    }

    // Upload
    move_uploaded_file($fileTmp, $targetDirectory);
    
    $uploadedPath = "/jobseeker/assets/uploads/cv-documents/${fileName}";
    saveCVPathToDb($uploadedPath);

}

function saveCVPathToDb($path){
    global $conn;
    $canId = $_SESSION['canId'];

    $path = mysqli_real_escape_string($conn, $path);
    $query = "UPDATE `candidate` SET `cvPath`='${path}' WHERE `canId`='${canId}'";
    
    if(mysqli_query($conn, $query)){
        return 1;
    }else{
        return 0;
    }
}
// Utils Functions End


if(isset($_POST['password'])){

    if( !isset($_SESSION['role']) || $_SESSION['role'] != "candidate" ){
        echo "<script>alert('Unauthorized. You not logged in as a job candidate.'); window.location.href='/jobseeker/pages/candidate/profile.php';</script>";
    }

    // Check all required feilds are present
    $validationStatus = checkFeilds();
    if($validationStatus == 0) return;

    $canId = $_SESSION['canId'];
    $password = $_POST['password'];

    // Authenticate candidate
    $authStats = auth($canId, $password);
    if($authStats == 0){
        echo "<script>alert('Invalid password. Cannot update profile data.'); window.location.href='/jobseeker/pages/candidate/profile.php';</script>";
        return;
    }

    // Update profile data
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // Update job to verified
    if(!updateProfileData($canId, $name, $address, $phone, $email)){
        header('Location: /jobseeker/pages/candidate/profile.php?msg=Failed%20to%20update%20record.');
    }
    
    uploadCV();
    // header('Location: /jobseeker/pages/candidate/profile.php?msg=Profile%20updated%20successfully.');

}


?>