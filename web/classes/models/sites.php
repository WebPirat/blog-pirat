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
}