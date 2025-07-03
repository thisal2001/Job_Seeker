<?php
    session_start();
    define('BASE_URL', "/jobseeker");
    define('CURRENT_PAGE', "home");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobSeeker - Homepage</title>

    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/global.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/responsive.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/pages/homepage.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/navbar.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/footer.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/buttons.css">

    

</head>
<body>

    <?php include "./assets/includes/navs/nav-common.php" ?>
    <?php include "./assets/includes/navs/nav-candidate.php" ?>
    <?php include "./assets/includes/navs/nav-recruiter.php" ?>
    <?php include "./assets/includes/navs/nav-admin.php" ?>

    <main id="container">

        <section id="one">
            
            <div class="col w-100">

                <br>

                <div class="d-flex-sm d-flex-md d-lg-none d-xl-none justify-center">
                    <img class="icon-lg" src="<?php echo BASE_URL?>/assets/illustrations/designer.svg" alt="Banner image">
                </div>

                <br>

                <h1>> Find your dream job</h1>
                <p class="text-justify">Your new beginning starts here. We're Job Seeker the leading digital recruitment company connecting the best talent with businesses around the world. Let us help and we'll become the best recruitment partner for you.</p>
            
                <br>

                <h1 class="text-center">> Welcome to JobSeeker</h1>
                <p class="text-center">Thank you for trying out JobSeeker. Let JobSeeker find your next dream job.</p>
                
                <br>

                <div class="d-flex justify-center">
                    <a href="<?php echo BASE_URL?>/pages/recruiter/create-job.php"><button class="btn button-filled mx-4">Create Job</button></a>
                    <a href="<?php echo BASE_URL?>/pages/jobs/"><button class="btn button-outline mx-4">Browse Jobs</button></a>
                </div>

            </div>
            
            <div class="col2 d-md-none d-sm-none">
                <div class="d-sm-none d-md-none d-flex-lg d-flex-xl justify-center">
                    <img class="icon-xl" src="<?php echo BASE_URL?>/assets/illustrations/designer.svg" alt="Banner image">
                </div>
            </div>

        </section>

        <br>

        <section id="two">
            <h1 class="text-center">Our Services</h1>

            <div class="services-square-list">

                <div class="services-square">
                    <p class="text-center">JobSeeker is a website that facilitates job hunting and range from large scale job categories such as engineering, legal, banking and insurance, social work, teaching, software industry, e.t.c as well as cross-sector categories such as green jobs, ethical jobs and seasonal jobs. Users can typically upload their resumes and submit them to potential employers and recruiters for review, while employers and recruiters can post job ads and search for potential employees.</p>
                </div>
                <div class="services-square">
                    <p class="text-center">JobSeeker is a site where employers can advertise jobs and search for resumes. We typically charge 10$ monthly  subscription fee from employers for unlimited job postings. After free site registation, employers can post infinite number of job listings through JobSeeker. To entice job seekers to apply, create job vacancy listings that are informative and engaging. We can asure to bring you the most qualified applicants and leverage a high return on your investment.</p>
                </div>
                <div class="services-square">
                    <ul>
                        <li>Conducting specialist recruitment.</li>
                        <br>
                        <li>Participation in the selection process.</li>
                        <br>
                        <li>Executive search (head hunting potential high calibre candidates).</li>
                        <br>
                        <li>Assistance with the preparation of selection documentation.</li>
                        <br>
                        <li>Handle initial enquiries and acknowledge applications.</li>
                        <br>
                        <li>Conduct verbal reference checks and skills tests.</li>
                    </ul>
                </div>

            </div>

        </section>

        <br>

        <section id="three">
            <h1 class="text-center">About Us</h1>

            <div class="content">
                <div class="col">
                    <div class="services-square-list">
                        <div class="services-square">
                            <p class="text-center">We are a fully distributed team of 5 people and our website is online 24/7.</p>
                        </div>
                        <div class="services-square">
                            <p class="text-center">Our aim is to build the best and efficient Recruitment management system.</p>
                        </div>
                        <div class="services-square">
                            <p class="text-center">This is a assignment project made by group MLB_01.01_10 for SLIIT IWT Module.</p>
                        </div>
                    </div>
                </div>

                <div class="col2">
                    <img src="https://source.unsplash.com/MYbhN8KaaEc" alt="">
                </div>
            </div>

        </section>

        <br>

        <section id="four">
            <h1 class="text-center">Here are some of our clients</h1>
            <div class="fake-logo-container">
                <img src="<?php echo BASE_URL?>/assets/fake-logos/1.svg" class="logo-sm">
                <img src="<?php echo BASE_URL?>/assets/fake-logos/2.svg" class="logo-sm">
                <img src="<?php echo BASE_URL?>/assets/fake-logos/3.svg" class="logo-sm">
                <img src="<?php echo BASE_URL?>/assets/fake-logos/4.svg" class="logo-sm">
                <img src="<?php echo BASE_URL?>/assets/fake-logos/5.svg" class="logo-sm">
                <img src="<?php echo BASE_URL?>/assets/fake-logos/6.svg" class="logo-sm">
                <img src="<?php echo BASE_URL?>/assets/fake-logos/7.svg" class="logo-sm">
            </div>
        </section>

        <br>
        <br>

    </main>

    <?php include './assets/includes/footer.php' ?>
    
    <script src="<?php echo BASE_URL?>/assets/js/navbar.js"></script>

</body>
</html>