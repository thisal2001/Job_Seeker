<?php

    session_start();

    include("../../config/db.php");
    
    define('BASE_URL', "/jobseeker");
    define('CURRENT_PAGE', "register");
    

    // Utils Functions
    function checkFeilds(){

        $validationPass=1;

        // Validate all paramaters exisiting
        if(!isset($_POST['username']) || 
        !isset($_POST['company']) ||
        !isset($_POST['email']) ||
        !isset($_POST['phone']) ||
        !isset($_POST['password']) ||
        !isset($_POST['confirm-password'])){
            echo "<script>alert('One or more feild are empty.')</script>";
            $validationPass=0;
        }

        // Check for empty parameters
        if(empty($_POST['username']) || empty($_POST['company']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['password']) || empty($_POST['confirm-password'])){
            echo "<script>alert('One or more feilds are empty.')</script>";
            $validationPass=0;
        }

        // Phone number check
        $phone=preg_replace('/[^0-9]/', '', $_POST['phone']);
        if(strlen($phone) != 10){
            echo "<script>alert('Phone number must include 10 digits.')</script>";
            $validationPass=0;
        }

        // Check password = confirm password
        if($_POST['password'] != $_POST['confirm-password']){
            echo "<script>alert('Given password does not match with Confirm Password.')</script>";
            $validationPass=0;
        }

        // Check email
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            echo "<script>alert('Invalid email format.')</script>";
            $validationPass=0;
        }

        return $validationPass;

    }

    function checkRecruiter($username){
        global $conn;
        $username=mysqli_real_escape_string($conn, $username);
        $query="SELECT * FROM `recruiter` WHERE `username`='${username}'";
        $result=mysqli_query($conn, $query);
        if(mysqli_num_rows($result) >= 1){
            echo "<script>alert('Recuiter username already exists. Try a different username.')</script>";
            return 1;
        }
        return 0;
    }

    function insertDB($username, $company, $email, $phone, $password){
        global $conn;
        $username = mysqli_real_escape_string($conn, $username);
        $hash = hash("sha512", $password);
        $company = mysqli_real_escape_string($conn, $company);
        $email = mysqli_real_escape_string($conn, $email);
        $phone = mysqli_real_escape_string($conn, $phone);

        $query="INSERT INTO `recruiter`(`username`, `hash`, `email`, `company`, `contact`) VALUES ('${username}','${hash}','${email}','${company}','${phone}')";
        if(mysqli_query($conn, $query)){
            echo "<script>alert('Submitted to admin for approval. Once approved you can login to your recruiter account.');</script>";
        }else{
            echo "<script>alert('Error while registering.')</script>";
        }
    }

    function msgListener(){
        if(isset($_GET['msg'])){
            $urldecoded = filter_var(urldecode($_GET['msg']), FILTER_SANITIZE_STRING);
            echo "<script>alert('${urldecoded}')</script>";
        }
    }
    // Utils Functions End


    function main(){

        // If already logged in. Redirect to spesific dashboard
        if(isset($_SESSION['role'])){
            header('Location: /jobseeker/pages/redirector.php');
        }

        // Form Submission
        if(isset($_POST['submit-btn'])){
            // Validation
            $validationStatus = checkFeilds();
            if($validationStatus == 0) return;
    
            // Start registering logic
            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
            $company = filter_input(INPUT_POST, "company", FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $phone = $_POST['phone'];
            $password = $_POST['password'];
    
            // Check if the username already existing
            $isCadidateAlreadyExisting = checkRecruiter($username);
            if($isCadidateAlreadyExisting) return;
            
            // Add to database
            insertDB($username, $company, $email, $phone, $password);
        }
    }

    main();
    msgListener();

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
        
        <h1 class="text-center my-4">Register Recruiter</h1>
        <hr class="underliner">

        <br>

        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
            <div class="details">
                <div class="input-box">
                    <label>Username</label>
                    <input class="inner" name="username" type="text" placeholder="Recruiter username">
                </div>

                <div class="input-box">
                    <label>Company</label>
                    <input type="text" class="inner" name="company" placeholder="Company name">
                </div>
                
                <div class="input-box">
                    <label>Email</label>
                    <input type="email" class="inner" name="email" placeholder="Recruiter email">
                </div>
                
                <div class="input-box">
                    <label>Phone</label>
                    <input type="text" class="inner" name="phone" placeholder="Recruiter phone number">
                </div>
                
                <div class="input-box">
                    <label>Password</label>
                    <input type="password" class="inner" name="password" placeholder="Recruiter password">
                </div>
                
                <div class="input-box">
                    <label>Confirm Password</label>
                    <input type="password" class="inner" name="confirm-password" placeholder="Confirm recruiter password">
                </div>

                <input type="submit" class="btn button-outline d-block mx-auto" name="submit-btn" value="Register Recruiter">
            </div>
        </form>

    </main>

    <?php include '../../assets/includes/footer.php' ?>
    
    <script src="<?php echo BASE_URL?>/assets/js/navbar.js"></script>

</body>
</html>