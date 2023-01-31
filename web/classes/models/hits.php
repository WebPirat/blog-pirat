<?php
namespace models;

class hits
{
    private $database;
    private $settings;
    private $blacklist = [];

    public function __construct()
    {
        $this->database = new \core\db();
        $this->settings = new \core\settings();
        $this->blacklist = ['/favicon.ico','/hi'];

        if($this->checkHitsBlacklist() > 0) {
            $this->purgeHitsDB();
        }
    }

    public function addHits()
    {
        $uri = $_SERVER['REQUEST_URI'];
        if($this->checkBlacklist($uri)) {
            if (empty($uri)) {
                $uri = '/';
            }
            $this->database->query('INSERT INTO hits (path) VALUES (?)', $uri);
        }
    }

    private function checkBlacklist($uri){
        if (in_array($uri, $this->blacklist)) {
            return false;
        }else{
            return true;
        }
    }

    private function purgeHitsDB(){
        foreach($this->blacklist as $path){
            $this->database->query('DELETE FROM hits WHERE path = ?', $path);
        }
    }
    private function checkHitsBlacklist(){
        $joinBlacklist = join("','", $this->blacklist);

        $sql = "SELECT * FROM hits WHERE path IN ('{$joinBlacklist}')";

        return $this->database->rawQuery($sql)->num_rows;
    }
}