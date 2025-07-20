<?php

include("../../../data_access/constants.php");

$mainRoot = $GLOBALS['website_domain'] . $GLOBALS['pages_root'];
if (isset($_COOKIE['org_email'])) {
    $root = $mainRoot . '/organizer/dashboard/dashboard.php';
} else {
    $root = $mainRoot . "/signin/signin.php";
}
header("location: $root");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Index</title>
</head>

<body class="pt-4 px-auto w-100">
    <div class="px-4 text-center">
        <h1>
            There must be a problem in redirection <br>
            please wait a second
        </h1>
        <h3>
            the page will refresh after <span id="timer">5</span> seconds
        </h3>
        <p>
            note: if the page still refresh and nothing change
            you can return to home page for now until we fix
            the problem
        </p>
    </div>

    <script>
        let time = 5
        setInterval(
            () => {
                document.getElementById('timer').innerText = time
                if (time === 0) {
                    location.reload()
                } else {
                    time--
                }
            }, 1000
        )
    </script>
</body>

</html>