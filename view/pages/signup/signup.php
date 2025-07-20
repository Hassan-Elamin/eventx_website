<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>
        .prof-img-view {
            margin: 8px 0;
            width: 150px;
            height: 150px;
            object-fit: cover;
            cursor: pointer;
        }

        .prof-img-view:hover {
            box-shadow: 0px 0px 20px var(--bs-dark);
            transition: 0.5s;
            transform: scale(0.85, 0.85);
        }
    </style>
    <title>Document</title>
</head>

<body>

    <div class="container mt-4">
        <div class="row mx-auto my-4 col-10">
            <h1 class="mx-auto text-center">
                Sign Up
            </h1>
            <?php
            if (isset($_FILES['profile-img'])) {
                $file_name = $_FILES['profile-img']['name'];
                $file_tmp_name = $_FILES['profile-img']['tmp_name'];
                $file_size = $_FILES['profile-img']['size'];
                $file_error = $_FILES['profile-img']['error'];
                $file_type = $_FILES['profile-img']['type'];
            }
            ?>
            <form action="./sign-up.php" method="post" onsubmit="return signupCheck()" enctype="multipart/form-data">
                <!-- profile img input and view -->
                <div class="text-center">
                    <label for="profile-img" class="form-label">
                        <img class="prof-img-view rounded-circle" src="../../../assets/images/no_image_user.png"
                            id="profile-img-view" alt="">
                    </label>
                </div>
                <input class="form-control" type="file" name="profile-img" id="profile-img" hidden>
                <!--  -->
                <div class="row d-flex flex-row justify-content-between">
                    <div class="col-md-6">
                        <label for="email-input" class="form-label mt-4">Email address</label>
                        <input type="email" name="email" class="form-control" id="email-input"
                            aria-describedby="emailHelp" placeholder="Enter email">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-6">
                        <label for="username-input" class="form-label mt-4">Username</label>
                        <input type="text" name="username" class="form-control" id="username-input"
                            placeholder="Enter username">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <!--  -->
                <div class="col-md-4 ">
                    <label for="birthdate-input" class="form-label mt-4">Birthdate</label>
                    <input type="date" name="birthdate" class="form-control" id="birthdate-input"
                        placeholder="Your birthdate">
                </div>
                <!-- password inputs -->
                <div class="row d-flex flex-row justify-content-between">
                    <div class="col-md-6">
                        <label for="password-input" class="form-label mt-4">Password</label>
                        <input type="password" name="password" class="form-control" id="password-input"
                            placeholder="Enter Password">
                    </div>
                    <div class="col-md-6 ">
                        <label for="repassword-input" class="form-label mt-4">Confirm Password</label>
                        <input type="password" class="form-control" id="repassword-input"
                            placeholder="confirm the password">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <!-- terms check -->
                <div class="form-check d-flex justify-content-center my-4">
                    <input class="form-check-input me-2" type="checkbox" value="" id="termsCheck" checked
                        aria-describedby="termsCheckHelpText" />
                    <label class="form-check-label" for="termsCheck">
                        I have read and agree to the terms
                    </label>
                </div>
                <div class="my-3 d-flex justify-content-center">
                    <span> already have email ? </span>
                    <a class="text-secondary" href="../signin/signin.php">Sign in</a>
                </div>
                <div class=" d-flex justify-content-center">
                    <input type="submit" name="submit" class="form-control btn btn-primary" id="submit" value="confirm">
                </div>
            </form>
        </div>

    </div>
    <script src="../../js/jquery-3.7.1.min.js"></script>
    <script src="./script.js"></script>
    <script>
        let passwordMatched = false
        let passwordValid = false
        let usernameValid = false

        function checkPasswordMatch() {
            if ($('#repassword-input').val() !== $('#password-input').val()) {
                console.log('true')
                passwordValid = false
                $('#repassword-input').next().text('password is not matched with repeat').css('display', 'block')
            } else {
                passwordValid = true
                $('#repassword-input').next().css('display', 'none')
            }
        }
        $('#password-input').on('input', function(ev) {
            checkPasswordMatch()
        })
        $('#repassword-input').on('input', function(ev) {
            checkPasswordMatch()
        })

        $('#email-input').on()

        $('#username-input').on('input', function(ev) {
            console.log(ev.target.value)
            if (ev.target.value.length > 4) {
                $('#username-input').next('.invalid-feedback')
                    .text('username must be more than 4 characters')
                    .css('display', 'block')
            } else {
                $('#username-input').next('.invalid-feedback')
                    .css('display', 'none')
            }
        })
    </script>
</body>

</html>