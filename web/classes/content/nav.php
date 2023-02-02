<?php
namespace content;

require_once ('autoloader.php');

class nav
{
    private $uri;
    private $database;
    private $settings;
    private $sites;
    private $router;

    public function __construct()
    {
        $this->database = new \core\db();
        $this->settings = new \core\settings();
        $this->sites = new \models\sites();
        //$this->router = new \core\router();
        $this->uri = $_SERVER['REQUEST_URI'];
    }

    public function getMainNav(){
        $nav = $this->sites->getSitesforNav();
        $title = $this->settings->getOneSetting('title', 'meta');
        $home = $this->settings->getOneSetting('home');


        echo $home;
        echo '<nav class="main-nav">';
            echo '';
            echo '<div class="main-img"><img src="/assets/img/logo.png" class="main-logo"></div>';
            echo '<div class="main-title">'.$title.'</div>';
            echo '<ul class="main-ul">';
                foreach ($nav as $link){
                 $aktiv = '';
                 if($link['ID'] == $home){
                     $aktiv = ' active';
                 }
                 echo '<li class="main-li'.$aktiv.'"><a href="'.$link['site_alias'].'">'.$link['ID'].'</a></li>';
                }
            echo '</ul>';
        echo '</nav>';
    }
}