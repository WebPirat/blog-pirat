<?php
namespace models;

use core\db;

class content
{
    private object $database;

    public function __construct()
    {
        $this->database = new db();
    }

    /**
     * @param $id
     * @return array
     */
    public function getContentByID($id) : array
    {
        return $this->database->query('SELECT * FROM content WHERE ID = ?', $id)->fetchArray();
    }

    /**
     * Gets name and sitealias not deleted and online
     * @return array
     */
    public function getContent($siteID): array
    {
        return $this->database->query('SELECT * FROM content WHERE deleted = 0 AND online = 1 AND siteID = ? ORDER BY sort_order', $siteID)->fetchAll();
    }
}