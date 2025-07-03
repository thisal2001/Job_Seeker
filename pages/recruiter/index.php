
<?php
    session_start();
    
    define('BASE_URL', "/jobseeker");
    define('CURRENT_PAGE', "dashboard");

    // Only recruiter has access to this page
    if(!isset($_SESSION['role']) && $_SESSION['role'] != "recruiter" ){
        header('Location: /jobseeker');
    }

    function msgListener(){
        if(isset($_GET['msg'])){
            $urldecoded = filter_var(urldecode($_GET['msg']), FILTER_SANITIZE_STRING);
            echo "<script>alert('${urldecoded}')</script>";
        }
    }

    msgListener();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobSeeker - Recruiter Dashboard</title>

    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/global.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/responsive.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/pages/registration.css">
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

    <?php include "../../assets/includes/navs/nav-recruiter.php" ?>

    <main id="container">
        <br>
        
        <h1 class="text-center my-4">Recruiter Dashboard</h1>
        <hr class="underliner">
        <p class="text-center my-6">Hello Recruiter 👋. Post your job vacancies at JobSeeker.</p>

        <br><br>

        <div id="content" class="d-flex">
            <div class="col">
                <a class="point" href="<?php echo BASE_URL?>/pages/recruiter/create-job.php">
                    <img class="icon-xs" src="<?php echo BASE_URL?>/assets/svg/tick.svg" alt="">
                    <p>Post Job Vacancy</p>
                </a>
                <a class="point" href="<?php echo BASE_URL?>/pages/recruiter/profile.php">
                    <img class="icon-xs" src="<?php echo BASE_URL?>/assets/svg/tick.svg" alt="">
                    <p>Visit Recruiter Pofile</p>
                </a>
            </div>

            <div class="col2">
                <img class="icon-xl d-block mx-auto" src="<?php echo BASE_URL?>/assets/illustrations/interview.svg" alt="dasboard-illustration">
            </div>
        </div>

        <br><br><br>

    </main>

    <?php include '../../assets/includes/footer.php' ?>
    
    <script src="<?php echo BASE_URL?>/assets/js/navbar.js"></script>

</body>
</html>