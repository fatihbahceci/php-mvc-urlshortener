<?php
class homeController extends controller
{
    private function verifyCaptcha($response)
    {
        $privatekey = "6Le9gR4TAAAAALjL8BVRkcP6XwZhYuPIqdsZejGJ";
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array(
            'secret' => $privatekey,
            'response' => $response,
        );
        $options = array(
            'http' => array(
                'method' => 'POST',
                'content' => http_build_query($data),
            ),
        );
        $context = stream_context_create($options);
        $verify = file_get_contents($url, false, $context);
        $response = json_decode($verify);
        return $response;
/*
{
"success": true|false,
"challenge_ts": timestamp,  // timestamp of the challenge load (ISO format yyyy-MM-dd'T'HH:mm:ssZZ)
"hostname": string,         // the hostname of the site where the reCAPTCHA was solved
"error-codes": [...]        // optional
}
 */
    }

    public function index()
    {
        // echo "<p>".$_SERVER['REQUEST_URI']."</p>";
        // echo "<p>".$_SERVER['HTTP_HOST']."</p>";
        // echo "<p>Get:".print_r($_GET,true)."</p>";
        if (srv::isPost()) {
            $response = $this->verifyCaptcha($_POST["g-recaptcha-response"]);

            if ($response->success) {
                $url = $_POST["url"];
                if (!filter_var($url, FILTER_VALIDATE_URL)) {
                    $this->render("home", "index", [
                        "success" => false,
                        "message" => "Geçersiz url!",
                        "url" => $url,

                    ]);
                } else {
                    require _models . "/surl.php";
                    $r = surl::createURL($url);
                    //http://php.net/parse_url
                    
                    if ($r["success"]) {
                        $this->render("home", "index", [
                            "success" => true,
                            "message" => "Urlniz: <pre>" . $_SERVER['HTTP_HOST'] . "/" . $r["url"]."</pre>",
                        ]);

                    } else {
                        $this->render("home", "index", [
                            "success" => false,
                            "message" => "Hata:" . print_r($r["err"], true),
                            "url" => $url,
                        ]);
                    }
                }

            } else {
                $this->render("home", "index", [
                    "success" => false,
                    "message" => "Lütfen robot olmadığınızı doğrulayın!",

                ]);
            }
        } else {
            $this->render("home", "index");
        }

    }
}
