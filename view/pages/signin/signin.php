<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    require "../../../data_access/database/php/connect_database.php";
    include '../../../business_logic/data_handlers/user_handler.php';
    include '../../../business_logic/data_handlers/organizers_handler.php';
    include '../../../data_access/constants.php';

    $userh = new UserHandler($database);
    $orgh = new Organizers_handler();

    function login($email, $password, $remember)
    {
        if (!empty($_COOKIE['org_email'])) {
            //destroy the cookie
            setcookie('org_email', '', time() - 3600, '/');
        }
        $u = $GLOBALS['userh']->getUser($email, $password);
        if (!is_string($u)) {
            $user = $u;
            $cookie_duration = 86400;
            if ($remember) {
                $cookie_duration *= 30;
            }
            setcookie('uid', $user->uid, time() + $cookie_duration, "/");
            $is_org = $GLOBALS['orgh']->isOrganizer($user->email);
            if ($is_org) {
                setcookie('org_email', $user->email, time() + (86400 * 30), "/");
            }
            header("Location: {$GLOBALS['website_domain']}/view/pages/user_profile/user_profile.php");
            exit();
        } else {
            echo "<h3 class='text-danger' > $u </h3>";
        }
    }
    ?>
    <!-- <div class="hero"></div> -->
    <div class="container justify-content-center py-4">
        <div class="mx-auto w-25" >
            <img 
            src="../../../assets/images/logo.png" 
            class="w-100"
            alt="logo">
        </div>
        <h1 class="text-center">SIGN IN</h1>
        <div class="text-center col-md-8 mx-auto">
            <form method="POST">
                <!-- Email input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" />
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4"><label class="form-label" for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" />
                </div>

                <!-- 2 column grid layout -->
                <div class="row mb-4">
                    <div class="col-md-6 d-flex justify-content-center">
                        <!-- Checkbox -->
                        <div class="form-check mb-3 mb-md-0">
                            <input class="form-check-input" name='remember' type="checkbox" id="loginCheck" />
                            <label class="form-check-label" for="loginCheck"> Remember me </label>
                        </div>
                    </div>

                    <div class="col-md-6 d-flex justify-content-center">
                        <!-- Simple link -->
                        <a href="#!">Forgot password?</a>
                    </div>
                </div>

                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">Sign in
                </button>

                <!-- Register buttons -->
                <div class="text-center">
                    <p>Not a member? <a href="../signup/signup.php">Sign up</a></p>
                </div>
            </form>
            <script>
                document.getElementById('loginCheck').addEventListener('change', function(ev) {
                    ev.target.value = (ev.target.checked)
                })
            </script>
            <?php
            if (isset($_POST['submit'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $remember = isset($_POST['remember']) ? true : false;
                login($email, $password, $remember);
            }
            ?>
        </div>
    </div>
</body>

</html>