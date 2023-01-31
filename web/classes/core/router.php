<?php
namespace core;
use models\hits;

require_once ('autoloader.php');

class router
{
    private $database;
    private $settings;
    private $hits;
    private $body;
    private $header;
    private $footer;
    private $firstUri;
    private $uri;
    public $navID;

    public function __construct()
    {
        $this->database = new db();
        $this->settings = new settings();
        $this->header = new \content\header();
        $this->body = new \content\body();
        $this->footer = new \content\footer();
        $this->hits = new hits();

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
    private function getFirstRoute($uri){
        $uriarray = array_filter(explode('/', $uri));
        if(isset($uriarray[1])) {
            return $uriarray[1];
        }else{
            return false;
        }
    }

    public function route(){
        $this->hits->addHits();
        $this->header->get();
        $this->body->get();
        $this->footer->get();
    }
}
