<?php
$pagesRoot = $_SERVER['DOCUMENT_ROOT'] . '/eventx_website/view/pages/';

?>
<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
        <img src="assets/images/logo.png" alt="" width="75">
        <a class="navbar-brand" href="#">EventX</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
            aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Home
                        <span class="visually-hidden">(current)</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">Trending</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">This Month</a>
                        <a class="dropdown-item" href="#">Hot Events</a>
                        <a class="dropdown-item" href="view/pages/discover/discover.php?following=true">Following</a>
                    </div>
                </li>
                <li class="nav-item">
                    <?php
                    $link = 'view/pages/user_profile/user_profile.php';
                    $btn_title = 'Become Organizer';
                    if (isset($_COOKIE['org_email'])) {
                        $link = 'view/pages/organizer/dashboard/dashboard.php';
                        $btn_title = 'Dashboard';
                    }
                    echo ("<a class='nav-link' href='$link'> $btn_title </a>");
                    ?>
                </li>
                <li class="nav-item dropdown">
                    <?php
                    if (isset($_COOKIE['uid'])) {
                        echo ('<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">Account</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="./view/pages/user_profile/user_profile.php">Manage Account</a>
                        <a class="dropdown-item" href="./view/pages/signin/signin.php">Change Account</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>');
                    } else {
                        $authpageroot = $pagesRoot . 'signin/signin.php';

                        echo ("
                        <a class='nav-link' href='./view/pages/signin/signin.php'>login/signup</a>
                        ");
                    }
                    ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./view/pages/about/about.html">About</a>
                </li>

            </ul>
            <form class="d-flex flex-column" id='search-form'>
                <div class="container">
                    <div class="searchInput">
                        <input type="text" placeholder="Search on Events" id="nav_search_input">
                        <div class="resultBox" id="nav_search_response">
                            <!-- here list are inserted from javascript -->
                        </div>
                        <div class="icon">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
    
</nav>