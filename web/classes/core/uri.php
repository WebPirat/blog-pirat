<?php
namespace core;

require_once ('autoloader.php');

class uri
{
    public $firstUri;
    private $uri;
    public $navID;

    public function __construct()
    {
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->firstUri = $this->getFirstRoute($_SERVER['REQUEST_URI']);
        $navLinks = $this->getUri();

    }
    /**
     * @return int
     */
    private function getHomeID(): int
    {
        $this->homeID = $this->settings->getOneSetting('home');
        if($this->homeID === 'Empty'){
            echo 'Keine Startseiten in denn Settings gesetzt!';
            exit;
        }
        return $this->homeID;
    }
    /**
     * @return mixed
     */
    public function getNavID()
    {
        if(empty($this->uri)){
            $navID = $this->getHomeID();
        }else{
            echo 'shiat';
        }

        return $this->navID;
    }
    private function getUri(){
        return ['yolo', 'about'];
    }
    public function getFirstRoute($uri){
        $uriarray = array_filter(explode('/', $uri));
        if(isset($uriarray[1])) {
            return $uriarray[1];
        }else{
            return false;
        }
    }

}
