<?php

class TreasureManager
{

    const BASE_URL = 'http://www.elitepvpers.com/forum/';

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = md5($password);

        $this->login();
    }

    /**
     * Creates a treasure
     *
     * @param Treasure $treasure
     */
    public function createTreasure(Treasure $treasure)
    {
        $url = 'http://www.elitepvpers.com/theblackmarket/treasures/';
        $referer = self::BASE_URL;
        $postFields = array(
            'title' => $treasure->getTitle(),
            'content' => $treasure->getContent(),
            'cost' => $treasure->getCost(),
            'createtreasure' => 'Submit'
        );
        $this->sendHttpPostRequest($url, $referer, $postFields);
    }

    /**
     * Login to get necessary cookies
     */
    private function login()
    {
        $url = self::BASE_URL . 'login.php?do=login';
        $referer = self::BASE_URL;
        $postFields = array(
            'do' => 'login',
            'vb_login_username' => $this->username,
            'vb_login_md5password' => $this->password,
            'vb_login_md5password_utf' => $this->password,
            'security_token' => 'guest',
            's' => '',
            'cookieuser' => '1'
        );
        $this->sendHttpPostRequest($url, $referer, $postFields);

        $url = self::BASE_URL . 'clientscript/vbulletin_global.js?v=373';
        $referer = self::BASE_URL . 'login.php?do=login';
        $this->sendHttpPostRequest($url, $referer);

        $url = self::BASE_URL . 'index.php';
        $referer = self::BASE_URL . 'login.php?do=login';
        $this->sendHttpPostRequest($url, $referer);
    }

    /**
     * Sends a HTTP Post Request
     *
     * @param $url
     * @param $referer
     * @param array $postFields
     * @return mixed
     */
    private function sendHttpPostRequest($url, $referer, array $postFields = array())
    {
        $postFields = http_build_query($postFields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__) . 'veri.txt');
        curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__) . 'veri.txt');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_COOKIESESSION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_REFERER, $referer);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        $exec = curl_exec($ch);
        curl_close($ch);

        return $exec;
    }
}