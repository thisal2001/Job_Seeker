<?php 

    include("../../config/db.php");
    session_start();

    define('BASE_URL', "/jobseeker");
    define('CURRENT_PAGE', "create-job");

    // If the user is not authenticated as a recruiter redirect to recruiter register page
    if(!isset($_SESSION['role']) && $_SESSION['role'] != "recruiter"){
        header('Location: /jobseeker/pages/register/recruiter.php?msg=Register%20as%20a%20recruiter%20to%20post%20your%20job%20vacancy.');
    }

    $recId = $_SESSION['recId'];

    // Util Functions
    function checkFeilds(){

        $validationPass=1;

        // Validate all paramaters exisiting
        if(!isset($_POST['title']) || 
        !isset($_POST['job-type']) ||
        !isset($_POST['location']) ||
        !isset($_POST['company']) ||
        !isset($_POST['description'])){
            echo "<script>alert('One or more feild are empty.')</script>";
            $validationPass=0;
        }

        // Check for empty parameters
        if(empty($_POST['title']) || empty($_POST['job-type']) || empty($_POST['location']) || empty($_POST['company']) || empty($_POST['description'])){
            echo "<script>alert('One or more feilds are empty.')</script>";
            $validationPass=0;
        }

        return $validationPass;

    }

    function insertDB($title, $jobType, $location, $company, $description){
        global $conn;
        global $recId;

        // Filter to SQL query
        $title = mysqli_real_escape_string($conn, $title);
        $jobType = mysqli_real_escape_string($conn, $jobType);
        $location = mysqli_real_escape_string($conn, $location);
        $company = mysqli_real_escape_string($conn, $company);
        $description = mysqli_real_escape_string($conn, $description);

        $query="INSERT INTO `jobs`(`title`, `type`, `location`, `body`, `company`, `jobVerified`, `recId`) VALUES ('${title}','${jobType}','${location}','${description}','${company}','0','${recId}')";
        if(mysqli_query($conn, $query)){
            echo "<script>alert('Submitted to admin for approval. Once approved your vacancy will be posted at JobSeeker.');</script>";
        }else{
            echo "<script>alert('Error while creating job.')</script>";
        }

    }
    // Util Functions End


    function main(){

        if(isset($_POST['submit-btn'])){
            // Validation
            $validationStatus = checkFeilds();
            if($validationStatus == 0) return;

            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_SPECIAL_CHARS);
            $jobType = filter_input(INPUT_POST, "job-type", FILTER_SANITIZE_SPECIAL_CHARS);
            $location = filter_input(INPUT_POST, "location", FILTER_SANITIZE_SPECIAL_CHARS);
            $company = filter_input(INPUT_POST, "company", FILTER_SANITIZE_SPECIAL_CHARS);
            $description = strip_tags($_POST['description']);

            // Add to database
            insertDB($title, $jobType, $location, $company, $description);
            
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
    <title>JobSeeker - Post Job Vacancy</title>

    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/global.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/responsive.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/pages/job-create.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/navbar.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/footer.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/buttons.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/cards.css">

    

</head>
<body>

    <?php include "../../assets/includes/navs/nav-recruiter.php" ?>

    <main id="container">
        <br>
        
        <h1 class="text-center my-4">Post Job Vacancy</h1>
        <hr class="underliner">
        <p class="text-center my-6">👇 Fill in the bellow given form 👇.</p>


        <div id="content" class="d-flex">
        
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
                <div class="details">
                    <div class="input-box">
                        <label>Job Title</label>
                        <input class="inner" name="title" type="text" placeholder="...">
                    </div>

                    <div class="input-box">
                        <label>Job Type</label>
                        <br>
                        <select name="job-type" id="">
                            <option value="">--- Choose Job Type ---</option>
                            <option value="part time">Part Time</option>
                            <option value="full time">Full Time</option>
                        </select>
                    </div>
                    
                    <div class="input-box">
                        <label>Location</label>
                        <input type="text" class="inner" name="location" placeholder="...">
                    </div>
                    
                    <div class="input-box">
                        <label>Company</label>
                        <input type="text" class="inner" name="company" placeholder="...">
                    </div>
                    
                    <div class="input-box">
                        <label>Job Vacancy Description</label>
                        <br>
                        <textarea name="description" id="" cols="30" rows="10"></textarea>
                    </div>

                    <input type="submit" class="btn button-outline d-block mx-auto" name="submit-btn" value="Submit Job Vacancy">
                </div>
            </form>

        </div>

    </main>

    <?php include '../../assets/includes/footer.php' ?>
    
    <script src="<?php echo BASE_URL?>/assets/js/navbar.js"></script>

</body>
</html>
