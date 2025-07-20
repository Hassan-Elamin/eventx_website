<?PHP

require './api_config.php';

if(isset($_POST['c'])){

}else{
    $output = [];
    $sql = "SELECT * FROM categories";
    $response = $GLOBALS['database']->query($sql);

    if ($response->num_rows > 0) {
        $output = $response->fetch_all(MYSQLI_ASSOC);
    }
    echo json_encode($output);
}