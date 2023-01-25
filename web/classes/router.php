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
        if(isset($uriarray[1])) {
            return $uriarray[1];
        }else{
            return false;
        }
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
