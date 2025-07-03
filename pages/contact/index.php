<?php

  session_start();

  define('BASE_URL', "/jobseeker");
  define('CURRENT_PAGE', "contact");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobSeeker - Browse Jobs</title>

    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/global.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/responsive.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/pages/contact.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/navbar.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/footer.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/buttons.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/assets/styles/cards.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">

    

</head>
<body>

    <?php include "../../assets/includes/navs/nav-common.php" ?>
    <?php include "../../assets/includes/navs/nav-candidate.php" ?>
    <?php include "../../assets/includes/navs/nav-recruiter.php" ?>
    <?php include "../../assets/includes/navs/nav-admin.php" ?>

    <main id="container">
        <br>

        <h1 class="text-center my-4">Contact</h1>
        <hr class="underliner">

        <p class="text-center">Get in touch and lets us know how we can help</p>

        <br><br>

        <div class="contact-info">
            <div class="card">
              <i class="card-icon far fa-envelope"></i>
              <p class="text-center">Jobseeker@dom.com</p>
            </div>
      
            <div class="card">
              <i class="card-icon fas fa-phone"></i>
              <p class="text-center">+940117544801</p>
            </div>
      
            <div class="card">
              <i class="card-icon fas fa-map-marker-alt"></i>
              <p class="text-center">Jobseeker,Kandy road,Malabe</p>
            </div>
        </div>

        <br><br>
        <p class="text-center mx-4">We're here to help and answer any question you might have. We look forward to hearing from you.</p>
        <br><br>

        <div class="contact-box">
          <div class="d-flex align-items-center">
            <div class="left d-sm-none d-md-none">
              <img src="<?php echo BASE_URL?>/assets/images/contact.png" alt="">
            </div>
            <div class="right">
              <h3>Send us a massage!</h3>
              <input type="text" class="field" placeholder="Your Name">
              <input type="text" class="field" placeholder="Your Email">
              <input type="text" class="field" placeholder="Phone">
              <textarea placeholder="Message" class="field"></textarea>
              <button class="btn button-filled w-48">Send</button>
            </div>
          </div>
        </div>
        

        <br><br>
    </main>

    <?php include '../../assets/includes/footer.php' ?>
    
    <script src="<?php echo BASE_URL?>/assets/js/navbar.js"></script>

</body>
</html>