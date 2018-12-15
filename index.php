<?php
//Deploy ederken bu ayarları kaldır
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//Notice hariç tüm uyarıları göster
error_reporting(E_ALL ^ E_NOTICE);

//System
define('_root', __DIR__); // Root
define('_core', _root . '/core'); // Çekirdek dizini
//Eğer model, view, ve controller klasörleri başka yerde tutulursa
// _app değişkenini ona göre ayarlamak için
define('_app', _root);
define('_controllers', _app . '/controllers'); // Controller dizini
define('_views', _app . '/views'); // Views dizini
define('_models', _app . '/models'); //Models dizini

//Config - Database
define('_db_connection_string', 'mysql:host=localhost;dbname=admin_buurl;charset=utf8');
define('_db_user_name', 'admin_buurl');
define('_db_password', 'ERFJdmtIUN');

require_once _core . "/app.php";

class handler_test implements iapp_event_handler
{
    public function on_app_created($app)
    {
        echo "<p> App Create </p>";
        
    }
    public function render_header()
    {
        require_once _views."/_layout/header.php";
    }
    public function render_footer()
    {
        require_once  _views."/_layout/footer.php";

    }

}

$app = new app(new handler_test());
$app->run();

//TODO: app_create()
// if (!C::isLoggedIn() && !($this->controller == "home" && $this->action == "login")) {
//     controller::redirect(path::build_GET("/home/login?redir=".$this->controller . "/" . $this->action, $this->params));
// }

//TODO: Path

// class path
// {
//     public static function build_GET($path, $params)
//     {
//         $q = http_build_query($params);
//         return $path . (!empty($q) ? "?" . $q : "");
//     }

// }
