<?php
namespace content;

use content\components\nav;
use content\sites\fallBack;
use core\settings;
use core\uri;
use models\sites;

class body
{
    private object $uri;
    private object $settings;
    private object $sites;
    public object $nav;
    public array $siteinfo;

    public function __construct($siteinfo)
    {
        $this->settings = new settings();
        $this->sites = new sites();
        $this->nav = new nav();
        $this->uri = new uri();
        $this->siteinfo = $siteinfo;
    }

    public function getContent() : void
    {
        $firstUri = null;
        if(!empty($this->siteinfo['uriarray'])) {
            $firstUri = $this->siteinfo['uriarray'][1];
        }
        $homeID = $this->siteinfo['homeID'];
        $content = (object)[];
        echo $firstUri;
        if(empty($firstUri) || $firstUri == '/'){
            $sitesarray = $this->sites->getSiteByID($homeID);
        }else{
            $sitesarray = $this->sites->getSiteByAlias($firstUri);
        }
        if(empty($sitesarray)){
            $this->get404();
        }else{
            if($sitesarray['site_alias'] === '/'){
                $sitesarray['site_alias'] = 'home';
            }
            $dynaClass = '\content\sites\\' . $sitesarray['site_alias'];
            if (class_exists($dynaClass)) {
                $content = new $dynaClass();
            }else{
                $content = new fallBack($sitesarray);
            }
        }
        echo '<div class="container">';
                $content->get();
        echo '</div>';
    }

    /**
     * @return void
     */
    public function get404(): void
    {
        echo '<div class="error-warning">Whoopsie da haben wir uns verzettelt <br> <a href="/">Zurück zur Startseite</a> </div>';
        echo '<div class="wrong-img"><img class="img-responsive" src="/assets/img/404.png" alt="BlogPirat in Trouble o.O"></div>';
    }

    public function get(): void
    {
        $this->nav->getMainNav();
        $this->getContent();
    }
}