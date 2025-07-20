<?php
if (!isset($_COOKIE['uid'])) {
    header('Location: ../signin/signin.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include '../../includes/head.php';
    include '../../../data_access/constants.php';
    ?>
    <link rel="stylesheet" href="style.css">
    <title>Profile</title>
</head>

<body>
    <div class="container">
        <?php
        include ('../../includes/app_header/header.php');
        //constants include
        
        include '../../../business_logic/data_handlers/organizers_handler.php';

        $img = empty($user->profile_img) ? $uploads_dir.$defaults_imgs_dir.'no_image_user.png'
            : $uploads_dir . $profile_imgs_dir . $user->profile_img;
        ?>
        <?php
        $uid = $_COOKIE['uid'];

        $userHandler = new UserHandler($database);
        $user = $userHandler->getUserById($uid);
        $uemail = $user->email;
        ?>

        <div class="row name-profile-element ">
            <img src="<?php print_r($user->profile_img); ?>" class="profile-img" alt="">
            <h4>
                <?php echo $user->username ?>
            </h4>
        </div>
        
        <style>
            .data-view-row {
                background-color: var(--bs-dark);
                color: white;
                padding: 8px 24px;
                border-radius: 12px;
                margin: 8px 0 ;
                display: flex;
                flex-direction: row;
                justify-content: space-between;
            }
        </style>

        <div class="row profile-details">
            <div class="form-group row text-center justify-content-center">
                
                <div class="col-sm-10 data-view-row ">
                    <span>Email:</span>
                    <span>
                        <?php echo $uemail; ?>
                    </span>
                </div>

                <div class="col-sm-10 data-view-row ">
                    <span>Username:</span>
                    <span>
                        <?php echo $user->username; ?>
                    </span>
                </div>

                <div class="col-sm-10 data-view-row ">
                    <span>Birthdate:</span>
                    <span>
                        <?php echo $user->birthdate; ?>
                    </span>
                </div>

            </div>

            <div class="row justify-content-evenly">
                <?php
                if (isset($_COOKIE['org_email'])) {
                    echo ('
                    <button class="col-4 btn btn-outline-warning" id="dashboard_nav_btn" > Dashboard </button>
                    ');
                }
                ?>
                <form action="logout.php" method="post">
                    <button name="logout-submit" class="col-4 btn btn-outline-danger">Log out</button>
                </form>

            </div>
        </div>

    </div>


    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="module" src="./scirpt.js"></script>
</body>

</html>