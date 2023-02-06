<?php
namespace models;
require_once ('autoloader.php');

class sites
{
    private $database;
    private $settings;
    private $headermenuID;
    private $footermenuID;

    public function __construct()
    {
        $this->database = new \core\db();
        $this->settings = new \core\settings();
        $this->headermenuID = $this->settings->getOneSetting('headerID', 'menu');
        $this->footermenuID = $this->settings->getOneSetting('footerID', 'menu');
    }

    /**
     * @param $id
     * @return array
     */
    public function getSiteByID($id) : array
    {
        return $this->database->query('SELECT * FROM sites WHERE ID = ?', $id)->fetchArray();
    }

    /**
     * @param $site_alias
     * @return array
     */
    public function getSiteByAlias($site_alias) : array
    {
        return $this->database->query('SELECT * FROM sites WHERE site_alias = ?', $site_alias)->fetchArray();
    }

    /**
     * Gets name and sitealias not deleted and online
     * @return array
     */
    public function getSitesforNav($footerID = NULL){
        if(empty($footerID)){
            $footerID = $this->settings->getOneSetting('headerID', 'menu');
        }
        return $this->database->query('SELECT ID, name, site_alias FROM sites WHERE deleted = 0 AND online = 1 AND menuID = ? ORDER BY sort_order', $footerID)->fetchAll();
    }
    public function getSitesforFooter($headerID = NULL){
        if(empty($headerID)){
            $headerID = $this->settings->getOneSetting('footerID', 'menu');
        }
        return $this->database->query('SELECT ID, name, site_alias FROM sites WHERE deleted = 0 AND online = 1 AND menuID = ? ORDER BY sort_order', $headerID)->fetchAll();
    }
    public function getSitesAlias(){
        return $this->database->query('SELECT ID, site_alias FROM sites WHERE deleted = 0 AND online = 1 ORDER BY sort_order')->fetchAll();
    }
}