import 'https://code.jquery.com/jquery-3.6.0.min.js';

$("#dashboard_nav_btn").click(function (e) { 
    e.preventDefault();
    window.location.replace('../organizer/dashboard/dashboard.php');
});