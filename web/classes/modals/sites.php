<?php
namespace modals;

use core\db;
use core\settings;
use helper\parseArray;

class sites
{
    private object $database;
    private object $settings;
    private object $parseArray;
    private int $headermenuID;
    private int $footermenuID;
    public $allSites;
    public array $allSitesMeta;

    public function __construct()
    {
        $this->database = new db();
        $this->settings = new settings();
        $this->parseArray = new parseArray();
        $this->headermenuID = $this->settings->getOneSetting('headerID', 'menu');
        $this->footermenuID = $this->settings->getOneSetting('footerID', 'menu');

        $this->allSitesMeta = $this->getSitesMeta();
        $this->allSites = $this->getAllSites();
    }


    public function getSitesAlias(){
        return $this->database->query('SELECT ID, name, site_alias FROM sites WHERE deleted = 0 AND online = 1 ORDER BY sort_order')->fetchAll();
    }
    public function getSitesMeta(){
        return $this->database->query('SELECT sitesID, title, description, img, keywords FROM sites_meta')->fetchAll();
    }
    private function getAllSites(){
        $sites = $this->getSitesAlias();
        foreach($sites as $key => $site) {
            $response[$key] = $site;
            $needle['sitesID'] = $site['ID'];
            $meta = $this->parseArray->findInArray($this->allSitesMeta, $needle);
            if(!empty($meta)){
                $response[$key]['meta'] = $meta[0];
            }
        }
        return $response;
    }

}