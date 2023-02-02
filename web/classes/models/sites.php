<?php
namespace models;
require_once ('autoloader.php');

class sites
{
    private $database;
    private $settings;
    private $site;
    private $siteID;

    public function __construct()
    {
        $this->database = new \core\db();
        $this->settings = new \core\settings();
    }

    /**
     * @param $id
     * @return array
     */
    public function getSiteByID($id) : array
    {
        return $this->database->query('SELECT * FROM settings WHERE ID = ?', $id)->fetchArray();
    }

    /**
     * @param $site_alias
     * @return array
     */
    public function getSiteByAlias($site_alias) : array
    {
        return $this->database->query('SELECT * FROM settings WHERE site_alias = ?', $site_alias)->fetchArray();
    }

    /**
     * Gets name and sitealias not deleted and online
     * @return array
     */
    public function getSitesforNav(){
        return $this->database->query('SELECT ID, name, site_alias FROM sites WHERE deleted = 0 AND online = 1 ORDER BY sort_order')->fetchAll();
    }
}