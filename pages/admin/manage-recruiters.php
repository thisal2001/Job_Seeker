
<?php 

include("../../config/db.php");
define('BASE_URL', "/jobseeker");
define('CURRENT_PAGE', "manage-recruiters");

session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] != "admin"){
    header('Location: /jobseeker');
}

$unverifiedRecruiters;

function getUnverifiedRecruiters(){
    global $conn;
    $query = "SELECT * FROM `recruiter` WHERE `isVerified`='0'";
    $result = mysqli_query($conn, $query);
    $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $result;
}


function main(){
    global $unverifiedRecruiters;
    $unverifiedRecruiters = getUnverifiedRecruiters();
}

function msgListener(){
    if(isset($_GET['msg'])){
        $urldecoded = filter_var(urldecode($_GET['msg']), FILTER_SANITIZE_STRING);
        echo "<script>alert('${urldecoded}')</script>";
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
<title>JobSeeker - Manage Recruiters</title>

<link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/global.css">
<link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/responsive.css">
<link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/pages/admin-manage-recruiters.css">
<link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/navbar.css">
<link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/footer.css">
<link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/buttons.css">




</head>
<body>

<?php include "../../assets/includes/navs/nav-admin.php" ?>

<main id="container">
    <br>
    
    <h1 class="text-center my-4">Manage Recruiters</h1>
    <hr class="underliner">
    <p class="text-center my-6">Use this interface to manage recruiters.</p>

    <br><br>

    <div id="recruiter-container">

        <?php foreach ($unverifiedRecruiters as $row) { ?>
            <div class="recruiter-list">
                <img src="https://ui-avatars.com/api/?name=<?php echo $row['username'] ?>&background=3d3d8e&rounded=true&bold=true&color=ffffff" alt="Recruiter Avatar">
                <div class="content">
                    <p class="pl-2 recruiter-username"><?php echo $row['username'] ?></p>
                    <div class="operational-icons">
                        <a href="<?php echo BASE_URL?>/utils/admin/addRecruiter.php?recId=<?php echo $row['recId']?>">
                            <img src="<?php echo BASE_URL?>/assets/svg/checkmark.svg" class="icon-xs">
                        </a>
                        <a href="<?php echo BASE_URL?>/utils/admin/rejectRecruiter.php?recId=<?php echo $row['recId']?>">
                            <img src="<?php echo BASE_URL?>/assets/svg/error.svg" class="icon-xs">
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if(count($unverifiedRecruiters) <= 0){ ?>
            <img class="icon-sm d-block mx-auto" src="<?php echo BASE_URL?>/assets/svg/box-empty.svg" alt="Empty Icon">
            <h3 class="text-center">No Pending Recruiters Found</h3>
        <?php } ?>
        
    </div>

    <br><br>

</main>

<?php include '../../assets/includes/footer.php' ?>

<script src="<?php echo BASE_URL?>/assets/js/navbar.js"></script>

</body>
</html>