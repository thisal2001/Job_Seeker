
<?php

    include("../../config/db.php");
    session_start();

    if(!isset($_SESSION['role']) || $_SESSION['role'] != "candidate"){
        header('Location: /jobseeker');
    }

    define('BASE_URL', "/jobseeker");
    define('CURRENT_PAGE', "profile");

    $candidateDetails;

    // Utils Funcs
    function getCandidateData($canId){
        global $conn;

        $canId = mysqli_real_escape_string($conn, $canId);
        $query = "SELECT * FROM `candidate` WHERE `canId`='${canId}'";
        $result = mysqli_query($conn, $query);
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $result[0];

    }

    function msgListener(){
        if(isset($_GET['msg'])){
            $urldecoded = filter_var(urldecode($_GET['msg']), FILTER_SANITIZE_STRING);
            echo "<script>alert('${urldecoded}')</script>";
        }
    }
    // Utils Funcs End


    function main(){

        global $candidateDetails;

        $canId = $_SESSION['canId'];
        $candidateDetails = getCandidateData($canId);

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
    <title>JobSeeker - Candidate Dashboard</title>

    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/global.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/responsive.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/pages/profile.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/navbar.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/footer.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/buttons.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/cards.css">

    

    <style>
        #content{
            display: flex;
            flex-direction: row;
        }
        #content > .col, #content > .col2{
            width: 50%;
        }
        #content > .col{
            display: flex;
            flex-direction: column;
            justify-content: center;
            flex-wrap: wrap;
            align-items: center;
        }
        #content > .col > .point{
            display: flex;
            width: 80%;
            height: fit-content;
            padding-left: 20px;
            padding-right: 20px;
            background-color: #ffe7d3;
            border-radius: 50px;
            border: 1px solid #ffa052;
            margin-bottom: 40px;
            text-decoration: none;
            color: initial;
            transition: .8s;
        }
        #content > .col > .point:hover{
            background-color: #dfdffd;
            border: 1px solid #0D0D82;
        }
        #content > .col > .point > p{
            margin-left: 20px;
        }
        @media(max-width: 768px){   /*MD*/
            #content{
                flex-direction: column;
            }
            #content > .col, #content > .col2{
                width: 100%;
            }
        }
    </style>

</head>
<body>

    <?php include "../../assets/includes/navs/nav-candidate.php" ?>

    <main id="container">
        <br>
        
        <h1 class="text-center my-4">Candidate Profile</h1>
        <hr class="underliner">
        <p class="text-center my-6">Here you will find all the candidate profile settings.</p>

        <br><br>

        <div id="content" class="d-flex">
            
            <form action="<?php echo BASE_URL?>/utils/candidate/update-profile.php" method="post" enctype="multipart/form-data">
                <div class="details">
                    <div class="input-box">
                        <label>Username (cannot be changed)</label>
                        <input class="inner" name="username" type="text" placeholder="Enter your name" value="<?php echo $candidateDetails['username']?>" disabled="" title="Cannot Update Username" required>
                    </div>

                    <div class="input-box">
                        <label>Email</label>
                        <input type="email" class="inner" name="email" placeholder="Enter your Email" value="<?php echo $candidateDetails['email']?>" title="Cannot Update Email" required>
                    </div>

                    <div class="input-box">
                        <label>Name</label>
                        <input type="text" class="inner" name="name" placeholder="Enter your address" value="<?php echo $candidateDetails['name']?>" required>
                    </div>
                    
                    <div class="input-box">
                        <label>Address</label>
                        <input type="text" class="inner" name="address" placeholder="Enter your address" value="<?php echo $candidateDetails['address']?>" required>
                    </div>
                    
                    <div class="input-box">
                        <label>Phone</label>
                        <input type="text" class="inner" name="phone" placeholder="Enter your Phone Number" value="<?php echo $candidateDetails['contactNo']?>" required>
                    </div>
                    
                    <div class="input-box w-100">
                        <label>Upload CV</label>
                        <br>
                        <input type="file" name="cv-document">
                    </div>

                    <hr>

                    <div class="input-box">
                        <label>Please enter your password to update profile:</label>
                        <input type="password" class="inner" name="password" placeholder="Enter your Password">
                    </div>

                    <input type="submit" class="btn button-outline d-block mx-auto w-48" name="submit-btn" value="Update Profile">
                </div>
            </form>


        </div>

        <br><br><br>

    </main>

    <?php include '../../assets/includes/footer.php' ?>
    
    <script src="<?php echo BASE_URL?>/assets/js/navbar.js"></script>

</body>
</html>