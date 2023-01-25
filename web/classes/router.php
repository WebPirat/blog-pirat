<?php
require_once ('autoloader.php');

class router
{
    private $database;
    private $firstUri;

    public function __construct()
    {
        $this->database = new db();
        $this->firstUri = $this->getFirstRoute($_SERVER['REQUEST_URI']);
        echo $this->firstUri;
        $navLinks = $this->getUri();

    }
    private function getUri(){
        return ['yolo', 'about'];
    }
    private function getFirstRoute($uri){
        $uriarray = array_filter(explode('/', $uri));
        print_r($uriarray);
        return $uriarray[1];
    }
    public function getHeader(){
        echo 'Header';
    }
    public function getContent(){
        echo 'Body';
    }
    public function getFooter(){
        echo 'Footer';
    }
}
