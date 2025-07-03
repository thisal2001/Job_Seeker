<?php
    include("../../config/db.php");
    session_start();

    define('BASE_URL', "/jobseeker");
    define('CURRENT_PAGE', "login");

    // Utils Functions
    function checkFeilds(){

        $validationPass = 1;

        // Validate all paramaters exisiting
        if(!isset($_POST['username']) || 
        !isset($_POST['password'])){
            echo "<script>alert('One or more feild are empty.')</script>";
            $validationPass = 0;
        }

        // Check for empty parameters
        if(empty($_POST['username']) || empty($_POST['password'])){
            echo "<script>alert('One or more feilds are empty.')</script>";
            $validationPass = 0;
        }

        return $validationPass;

    }

    function auth($username, $password){
        global $conn;
        $username = mysqli_real_escape_string($conn, $username);
        $query = "SELECT * FROM `admin` WHERE `username`='${username}'";
        $result = mysqli_query($conn, $query);

        // Username Check
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
    // Utils Functions End

    function main(){

        // If already logged in. Redirect to spesific dashboard
        if(isset($_SESSION['role'])){
            header('Location: /jobseeker/pages/redirector.php');
        }

        // Login form submission
        if(isset($_POST['submit-btn'])){
            // Validation
            $validationStatus = checkFeilds();
            if($validationStatus == 0) return;

            // Authenticate
            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
            $password = $_POST['password'];
            $authStats = auth($username, $password);

            if($authStats == 0){
                echo "<script>alert('Invalid username or password.')</script>";
                return;
            }

            $_SESSION['username'] = $username;
            $_SESSION['role'] = "admin";

            echo "<script>alert('Status: Logged in as admin. Click ok to access your dashboard.'); window.location.href='/jobseeker/pages/admin/';</script>";
        }

    }

    main();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobSeeker - Login</title>

    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/global.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/responsive.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/pages/login.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/navbar.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/footer.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/buttons.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/cards.css">

    

</head>
<body>

    <?php include "../../assets/includes/navs/nav-common.php" ?>

    <main id="container">

        <div class="col admin-bg d-sm-none d-md-none"></div>

        <div class="col2">
            <br>
            <h1 class="text-center my-4">Administrator Login</h1>
            <hr class="underliner">

            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
                <div class="inputBx">
                    <span>Username</span>
                    <input type="text" name="username" required>
                </div>
                <div class="inputBx">
                    <span>Password</span>
                    <input type="password" name="password" required>
                </div>

                <input type="submit" id="login-btn" class="btn button-filled w-48 d-block mx-auto" name="submit-btn" value="Login">

            </form>

            <br><br>

        </div>


    </main>

    <?php include '../../assets/includes/footer.php' ?>
    
    <script src="<?php echo BASE_URL?>/assets/js/navbar.js"></script>

</body>
</html>