
<?php 

include("../../config/db.php");
define('BASE_URL', "/jobseeker");
define('CURRENT_PAGE', "manage-jobs");

session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] != "admin"){
    header('Location: /jobseeker');
}

$jobDetails;

// Util Functions
function getJobDetails($jobId){
    global $conn;
    $jobId = mysqli_real_escape_string($conn, $jobId);
    $query = "SELECT * FROM `jobs` WHERE `jobId`='${jobId}'";
    $result = mysqli_query($conn, $query);
    $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $result;
}

function msgListener(){
    if(isset($_GET['msg'])){
        $urldecoded = filter_var(urldecode($_GET['msg']), FILTER_SANITIZE_STRING);
        echo "<script>alert('${urldecoded}')</script>";
    }
}
// Util Functions End


function main(){
    global $jobDetails;
    if(!isset($_GET['jobId'])){
        echo "<script>alert('Missing parameter.');window.location.href='/jobseeker/pages/admin/';</script>";
    }

    $jobDetails = getJobDetails($_GET['jobId']);
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

<?php include "../../assets/includes/navs/nav-admin.php" ?>

<main id="container">
    <br>
    
    <h1 class="text-center my-4">Manage Jobs Vacanines</h1>
    <hr class="underliner">
    <p class="text-center my-6">New job vacanines posted by recruiters are here. Go through & verify the vacanines in order to publish to JobSeeker.</p>

    <br>

    <div id="job-details">
        <?php foreach ($jobDetails as $row) { ?>
            <p class="my-6">
                <b>1. Job Title</b>: <?php echo $row['title'] ?>
            </p>
            <p class="my-6">
                <b>2. Job Type</b>: <?php echo $row['type'] ?>
            </p>
            <p class="my-6">
                <b>3. Location</b>: <?php echo $row['location'] ?>
            </p>
            <p class="my-6">
                <b>4. Company</b>: <?php echo $row['company'] ?>
            </p>
            <div class="d-block my-6">
                <p><b>5. Job Description:</b></p>
                <pre>
                    <?php echo trim(str_replace("  ", " ", $row['body'])) ?>
                </pre>
            </div>
        <?php } ?>
    </div>

    <br>

    <div class="d-flex justify-center my-6">
        <a href="<?php echo BASE_URL?>/utils/admin/rejectJob.php?jobId=<?php echo $row['jobId'] ?>" class="btn button-filled-danger w-48 mx-4">Reject</a>
        <a href="<?php echo BASE_URL?>/utils/admin/addJob.php?jobId=<?php echo $row['jobId'] ?>" class="btn button-filled w-48 mx-4">Approve</a>
    </div>

    <br><br>



</main>

<?php include '../../assets/includes/footer.php' ?>

<script src="<?php echo BASE_URL?>/assets/js/navbar.js"></script>

</body>
</html>