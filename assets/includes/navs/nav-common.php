
<?php if( !isset($_SESSION['role']) ){ ?>
    <p class="text-center text-success">Debug Info: Not Logged in. Viewing as a public user.</p>
    <nav id="navbar-lg" class="d-sm-none d-md-none d-lg-flex align-items-center">
        <div class="navbar-logo">
            <a href="<?php echo BASE_URL?>">
                <img class="logo-md" src="<?php echo BASE_URL?>/assets/logos/jobseeker.png" alt="Logo">
            </a>
        </div>

        <ul class="nav-item-wrapper">
            <?php echo '<li class="nav-item' . (CURRENT_PAGE=='home' ? ' active' : ''). '">' ?>
                <a class="nav-link" href="<?php echo BASE_URL?>/">Home</a>
            </li>
            <?php echo '<li class="nav-item' . (CURRENT_PAGE=='jobs' ? ' active' : ''). '">' ?>
                <a class="nav-link" href="<?php echo BASE_URL?>/pages/jobs">Job Listing</a>
            </li>
            <?php echo '<li class="nav-item' . (CURRENT_PAGE=='contact' ? ' active' : ''). '">' ?>
                <a class="nav-link" href="<?php echo BASE_URL?>/pages/contact">Contact Us</a>
            </li>
            <?php echo '<li class="nav-item' . (CURRENT_PAGE=='login' ? ' active' : ''). '">' ?>
                <a class="nav-link" href="<?php echo BASE_URL?>/pages/login">Login</a>
            </li>
            <?php echo '<li class="nav-item' . (CURRENT_PAGE=='register' ? ' active' : ''). '">' ?>
                <a class="nav-link" href="<?php echo BASE_URL?>/pages/register">Register</a>
            </li>
        </ul>
    </nav>

    <nav id="navbar-sm" class="d-block-sm d-block-md d-lg-none d-xl-none mx-4">
        <div class="nav d-flex align-items-center justify-items-between pt-4">
            <div class="navbar-logo">
                <a href="<?php echo BASE_URL?>">
                    <img class="logo-md" src="<?php echo BASE_URL?>/assets/logos/jobseeker.png" alt="Logo">
                </a>
            </div>
            
            <div class="dropdown">
                <img id="hamburger" toggle="off" src="<?php echo BASE_URL?>/assets/svg/hamburger.svg" alt="">
            </div>
        </div>

        <ul class="nav-item-wrapper d-none">
            <?php echo '<li class="nav-item' . (CURRENT_PAGE=='home' ? ' active' : ''). '">' ?>
                <a class="nav-link" href="<?php echo BASE_URL?>">Home</a>
            </li>
            <?php echo '<li class="nav-item' . (CURRENT_PAGE=='jobs' ? ' active' : ''). '">' ?>
                <a class="nav-link" href="<?php echo BASE_URL?>/pages/jobs">Job Listing</a>
            </li>
            <?php echo '<li class="nav-item' . (CURRENT_PAGE=='contact' ? ' active' : ''). '">' ?>
                <a class="nav-link" href="<?php echo BASE_URL?>/pages/contact">Contact Us</a>
            </li>
            <?php echo '<li class="nav-item' . (CURRENT_PAGE=='login' ? ' active' : ''). '">' ?>
                <a class="nav-link" href="<?php echo BASE_URL?>/pages/login">Login</a>
            </li>
            <?php echo '<li class="nav-item' . (CURRENT_PAGE=='register' ? ' active' : ''). '">' ?>
                <a class="nav-link" href="<?php echo BASE_URL?>/pages/register">Register</a>
            </li>
        </ul>

    </nav>

<?php } ?>
