<?php
// This php code is responsible for updating recruiter profile details

include("../../config/db.php");

session_start();

// Utils Functions
function checkFeilds(){

    $validationPass = 1;

    // Validate all paramaters exisiting
    if(!isset($_POST['email']) || 
    !isset($_POST['phone'])){
        echo "<script>alert('One or more feild are empty.')</script>";
        $validationPass = 0;
    }

    // Check for empty parameters
    if(empty($_POST['email']) || empty($_POST['phone'])){
        echo "<script>alert('One or more feilds are empty.')</script>";
        $validationPass = 0;
    }

    return $validationPass;

}

function auth($recId, $password){
    global $conn;

    $recId = mysqli_real_escape_string($conn, $recId);
    $query = "SELECT * FROM `recruiter` WHERE `recId`='${recId}'";
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

function updateProfileData($recId, $phone, $email){
    global $conn;

    $recId = mysqli_real_escape_string($conn, $recId);
    $email = mysqli_real_escape_string($conn, $email);
    $phone = mysqli_real_escape_string($conn, $phone);

    $query = "UPDATE `recruiter` SET `email`='${email}',`contact`='${phone}' WHERE `recId`='${recId}'";

    if(mysqli_query($conn, $query)){
        return 1;       // Query executed successfully
    }
    return 0;           // Query execution failed

}

function uploadLogo(){
    if(empty($_FILES['company-logo']['name'])){
        // Logo not uploaded
        return;
    }

    // Get file attributes
    $fileName = $_FILES['company-logo']['name'];
    $fileSize = $_FILES['company-logo']['size'];
    $fileTmp = $_FILES['company-logo']['tmp_name'];
    $targetDirectory = $_SERVER['DOCUMENT_ROOT'] . "/jobseeker/assets/uploads/company-logos/${fileName}";
    $fileExt = strtolower(end(explode('.', $fileName)));
    $maxFileSize = 20 * 1024 * 1024;     // In Bytes
    $allowedExtenstions = ['png', 'jpg', 'jpeg'];

    // Check file type
    if(!in_array($fileExt, $allowedExtenstions)){
        header('Location: /jobseeker/pages/recruiter/profile.php?msg=Only%20PDF%20files%20are%20allowed.');
        return;
    }

    // Check file size
    if($fileSize > $maxFileSize){
        header('Location: /jobseeker/pages/recruiter/profile.php?msg=Maximum%20upload%20size%20is%2020%20MB');
        return;
    }

    // Upload
    move_uploaded_file($fileTmp, $targetDirectory);
    
    $uploadedPath = "/jobseeker/assets/uploads/company-logos/${fileName}";
    saveLogoPathToDb($uploadedPath);

}

function saveLogoPathToDb($path){
    global $conn;
    $recId = $_SESSION['recId'];

    $path = mysqli_real_escape_string($conn, $path);
    $query = "UPDATE `recruiter` SET `profilePicPath`='${path}' WHERE `recId`='${recId}'";
    
    if(mysqli_query($conn, $query)){
        return 1;
    }else{
        return 0;
    }
}
// Utils Functions End


if(isset($_POST['password'])){

    if( !isset($_SESSION['role']) || $_SESSION['role'] != "recruiter" ){
        echo "<script>alert('Unauthorized. You not logged in as a recruiter.'); window.location.href='/jobseeker/pages/recruiter/profile.php';</script>";
    }

    // Check all required feilds are present
    $validationStatus = checkFeilds();
    if($validationStatus == 0) return;

    $recId = $_SESSION['recId'];
    $password = $_POST['password'];

    // Authenticate recruiter
    $authStats = auth($recId, $password);
    if($authStats == 0){
        echo "<script>alert('Invalid password. Cannot update profile data.'); window.location.href='/jobseeker/pages/recruiter/profile.php';</script>";
        return;
    }

    // Update profile data
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // Update job to verified
    if(!updateProfileData($recId, $phone, $email)){
        header('Location: /jobseeker/pages/recruiter/profile.php?msg=Failed%20to%20update%20record.');
    }
    
    uploadLogo();
    header('Location: /jobseeker/pages/recruiter/profile.php?msg=Profile%20updated%20successfully.');

}


?>