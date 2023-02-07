<?php
namespace content\components;

require_once ('autoloader.php');

class nav
{
    private $uri;
    private $database;
    private $settings;
    private $sites;

    public function __construct()
    {
        $this->database = new \core\db();
        $this->settings = new \core\settings();
        $this->sites = new \models\sites();
        $this->uri = new \core\uri();
    }

    public function getMainNav(){
        $nav = $this->sites->getSitesforNav();
        $title = $this->settings->getOneSetting('title', 'meta');
        $home = $this->settings->getOneSetting('home');
        $firstUri = $this->uri->firstUri;

        echo '<nav class="main-nav">';
            echo '';
            echo '<div class="main-img"><img src="/assets/img/logo.png" class="main-logo"></div>';
            echo '<div class="main-title">'.$title.'</div>';
            echo '<ul class="main-ul">';
                foreach ($nav as $link){
                 $aktiv = '';
                 if($link['ID'] == $home && empty($firstUri)){
                     $aktiv = ' active';
                 }
                 if(strtolower($link['site_alias']) == strtolower($firstUri)){
                     $aktiv = ' active';
                 }
                 echo '<li class="main-li'.$aktiv.'"><a href="'.$link['site_alias'].'">'.$link['name'].'</a></li>';
                }
            echo '</ul>';
        echo '</nav>';
    }
}