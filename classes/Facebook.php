<?php
require_once('/config.php');
require_once('/classes/Facebook/User.php');

class Facebook
{
    public $params = array();

    public function __construct()
    {
        //session_start();
        $this->params['code'] = $_SESSION['code'];
        $this->params['client_id'] = $GLOBALS['client_id'];
        $this->params['redirect_uri'] = $GLOBALS['redirect_uri'];
        $this->params['client_secret'] = $GLOBALS['client_secret'];
    }

    public static function getAuthLink()
    {
        return $GLOBALS['url'] . '?' . urldecode(http_build_query($GLOBALS['params']));
    }

    //https://graph.facebook.com/oauth/access_token?code=&client_id=1651834448163231&client_secret=b36a7f20414820008a99c395334ca599&redirect_uri=http://localhost/
    function get_access_token($code)
    {
        $url = 'https://graph.facebook.com/oauth/access_token';
        $token_params = array(
            "code" => $code,//$_SESSION['code'],
            "client_id" => $this->params['client_id'],
            "client_secret" => $this->params['client_secret'],
            "redirect_uri" => $this->params['redirect_uri'],
        );
        echo '<br><br><br><br>';
        $response = json_decode(self::cURL('post', $url, $token_params), true);
        //echo preg_replace('/(&expires=\d+)|(access_token=)| /', '', self::cURL('post', $url, $token_params));
        return $response['access_token'];
    }

    public function getUser($access_token)
    {
        return new User($access_token);
    }
    
    public static function cURL($method, $url, $params)
    {
        if ($method == 'get' || $method == 'post') {
            $ch = curl_init();
            if ($method == 'get')
                $url .= '?' . http_build_query($params);
            // $url = http_build_url($url, $params);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            if ($method == 'post') {
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            }
            $res = curl_exec($ch);
            curl_close($ch);
            if ($method == 'get')
                return json_decode($res, true);
            else return $res;
        } else
            return;
    }
}

?>