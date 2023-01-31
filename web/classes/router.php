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
                </head>';
    }
    public function getContent(){
        echo 'Body';
    }
    public function getFooter(){
        echo 'Footer';
    }
}
