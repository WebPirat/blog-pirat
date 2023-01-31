<?php
require_once ('autoloader.php');

class router
{
    private $database;
    private $settings;
    private $firstUri;
    private $uri;

    public function __construct()
    {
        $this->database = new db();
        $this->settings = new settings();

        $this->uri = $_SERVER['REQUEST_URI'];
        $this->firstUri = $this->getFirstRoute($_SERVER['REQUEST_URI']);
        $navLinks = $this->getUri();

    }
    private function getUri(){
        return ['yolo', 'about'];
    }
    private function getFirstRoute($uri){
        $uriarray = array_filter(explode('/', $uri));
        if(isset($uriarray[1])) {
            return $uriarray[1];
        }else{
            return false;
        }
    }
    public function getHeader(){
        $title = $this->settings->getOneSetting('title', 'meta');
        echo '<!DOCTYPE html>
                <html>
                <head>                
                  <title>'.$title.'</title>
                    <link rel="apple-touch-icon" sizes="180x180" href="/assets/icon/apple-touch-icon.png">
                    <link rel="icon" type="image/png" sizes="32x32" href="/assets/icon/favicon-32x32.png">
                    <link rel="icon" type="image/png" sizes="16x16" href="/assets/icon/favicon-16x16.png">
                    <link rel="manifest" href="/assets/icon/site.webmanifest">
                    <link rel="mask-icon" href="/assets/icon/safari-pinned-tab.svg" color="#5bbad5">
                    <link rel="shortcut icon" href="/assets/icon/favicon.ico">
                    <link rel="stylesheet" href="/assets/css/blogpirat.css">
                    <meta name="msapplication-TileColor" content="#da532c">
                    <meta name="msapplication-config" content="/assets/icon/browserconfig.xml">
                    <meta name="theme-color" content="#ffffff">
                </head>';
    }
    public function getContent(){
        echo '<body class="container">';
        echo 'Yolo';
        echo '</body>';
    }
    public function getFooter(){
        echo '</html>';
    }
}
