
<?php 

include("../../config/db.php");
define('BASE_URL', "/jobseeker");
define('CURRENT_PAGE', "manage-jobs");

session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] != "admin"){
    header('Location: /jobseeker');
}

$unverifiedJobs;

// Util Functions
function getUnverifiedJobs(){
    global $conn;
    $query = "SELECT * FROM `jobs` WHERE `jobVerified`='0'";
    $result = mysqli_query($conn, $query);
    $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $result;
}

function getUsername($recId){
    global $conn;
    $query = "SELECT username FROM `recruiter` WHERE `recId`='${recId}'";
    $result = mysqli_query($conn, $query);
    $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $result[0]['username'];
}

function msgListener(){
    if(isset($_GET['msg'])){
        $urldecoded = filter_var(urldecode($_GET['msg']), FILTER_SANITIZE_STRING);
        echo "<script>alert('${urldecoded}')</script>";
    }
}
// Util Functions End


function main(){
    global $unverifiedJobs;
    $unverifiedJobs = getUnverifiedJobs();
}

main();
msgListener()

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
<link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/cards.css">



<style>
    .recruiter-username{
        text-transform: capitalize;
    }
    .view-job-btn{
        height: fit-content;
        color: inherit;
        text-decoration: none;
        font-weight: 400;
    }
    .content{
        align-items: center;
    }
</style>

</head>
<body>

<?php include "../../assets/includes/navs/nav-admin.php" ?>

<main id="container">
    <br>
    
    <h1 class="text-center my-4">Manage Jobs Vacanines</h1>
    <hr class="underliner">
    <p class="text-center my-6">New job vacanines posted by recruiters are here. Go through & verify the vacanines in order to publish to JobSeeker.</p>

    <br>

    <div id="recruiter-container">

        <?php foreach ($unverifiedJobs as $row) { ?>
            <div class="recruiter-list">
                <?php $username = getUsername($row['recId']); ?>
                <img src="https://ui-avatars.com/api/?name=<?php echo $username ?>&background=3d3d8e&rounded=true&bold=true&color=ffffff" alt="Recruiter Avatar">
                <div class="content">
                    <p class="pl-2"><u class="recruiter-username"><?php echo $username ?></u>, posted a job vacancy.</p>
                    <div class="operational-icons">
                        <a class="btn button-filled view-job-btn" href="<?php echo BASE_URL?>/pages/admin/view-job.php?jobId=<?php echo $row['jobId']?>">View</a>
                    </div>
                </div>
            </div>
        <?php } ?>


        <?php if(count($unverifiedJobs) <= 0){ ?>
            <img class="icon-sm d-block mx-auto" src="<?php echo BASE_URL?>/assets/svg/box-empty.svg" alt="Empty Icon">
            <h3 class="text-center">No Jobs Found</h3>
        <?php } ?>
        
    </div>

    <br><br>



</main>

<?php include '../../assets/includes/footer.php' ?>

<script src="<?php echo BASE_URL?>/assets/js/navbar.js"></script>

</body>
</html>