<?php
include $_SERVER['DOCUMENT_ROOT'] . '/eventx_website/data_access/constants.php';
include $_SERVER['DOCUMENT_ROOT'] . '/eventx_website/business_logic/data_handlers/user_handler.php';
$user_handle = new UserHandler($GLOBALS['database']);
$user = $user_handle->getUserById($_COOKIE['uid']);
unset($user_handle);
$contact = $website_domain .$pages_root. '/contact/contact.html';
$about = $website_domain . $pages_root . '/about/about.html';
?>

<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">

        <img src="https://firebasestorage.googleapis.com/v0/b/notepad-back-up-and-restore.appspot.com/o/users-images%2Flogo.png?alt=media&token=53364d37-d154-4ef3-bbd5-f7b03ad8f4be"
            alt="" width="75">
        <a class="navbar-brand" href="http://localhost/eventx_website">EventX</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
            aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse flex-row align-items-center justify-content-between" id="navbarColor01">
            <ul class="navbar-nav me-auto align-items-center justify-content-between">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $website_domain ?>">Home
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">Trending</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">This Month</a>
                        <a class="dropdown-item" href="#">Hot Events</a>
                        <a class="dropdown-item" href="#">Following</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">Account</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="../signin/signin.php">login</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <?php 
                if(isset($_COOKIE['org_email'])){
                    $link = $contact = $website_domain . $pages_root .'/organizer/';

                    echo ("
                    <li class='nav-item'>
                            <a class='nav-link' href='$link'>Dashboard</a>
                    </li>
                    ");
                }
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $contact ?>">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $about?>">About</a>
                </li>
                <li class="nav-item dropdown">
                    <form class="d-flex flex-column" id='search-form'>
                        <div class="container">
                            <div class="searchInput">
                                <input type="text" placeholder="Search on Events" id="nav_search_input">
                                <div class="icon">
                                    <i class="fas fa-search"></i>
                                </div>
                                <div class="resultBox" id="nav_search_response">
                                    <!-- here list are inserted from javascript -->
                                </div>
                            </div>
                        </div>
                    </form>
                </li>
                <?php

                $link = '';
                $link = $website_domain . $pages_root;
                if (isset($_COOKIE['uid'])) {
                    $link .= '/user_profile/user_profile.php';
                } else {
                    $link .= '/signin/signin.php';
                }
                ?>
                <li class="nav-item dropdown pf-img">
                    <a href="<?php echo $link ?>" class='profile-img-avatar m-3'>
                        <img src='<?php echo $user->profile_img ?>' alt=''>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>