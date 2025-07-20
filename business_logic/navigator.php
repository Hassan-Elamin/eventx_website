<?PHP 

class Navigator {

    private $pages_dir ;
    
    public function __construct() {
        require '../data_access/constants.php';
        $this->pages_dir = $GLOBALS['website_domain'].$GLOBALS['pages_root'];
    }

    public function navigate($page_root) {
        echo ("
        <script>
        window.location.href = '$this->pages_dir/$page_root';
        </script>
        ");
    }

    public function goBack(){
        echo ("
        <script>
        history.go(-1);
        </script>
        ");
    }

    public function navigateIf(bool $cond , $page_root ) {
        if ($cond) {
            $this->navigate($page_root);
        }else {
            echo ("
            <script>
            window.location.href = '$this->pages_dir/error_pages/404.php';
            </script>
            ");
        }
    }
}