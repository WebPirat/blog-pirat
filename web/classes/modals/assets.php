<?php
namespace modals;
use core\db;

class assets
{
    private object $database;

    public array $allAssets;

    public function __construct()
    {
        $this->database = new db();
        $this->allAssets = $this->getAllAssets();
    }


    public function getAllAssets() : array
    {
        return $this->database->query('SELECT fullpath, dirname, basename, extension, filename, filesize, hash FROM assets WHERE deleted != 1 OR deleted IS NULL')->fetchAll();
    }

    public function saveAsset($fullpath, $dirname, $basename, $extension, $filename, $hash, $filesize)
    {
        $insert = $this->database->query('INSERT INTO assets (fullpath, dirname, basename, extension, filename, hash, filesize) VALUES (?,?,?,?,?,?,?)', $fullpath, $dirname, $basename, $extension, $filename, $hash, $filesize);
        return $insert->affectedRows();
    }
    public function updateAsset($fullpath, $dirname, $basename, $extension, $filename, $hash, $filesize)
    {
        $schema = $this->database->getSchema('assets');
        exit;
        $insert = $this->database->query('UPDATE assets  SET fullpath = ?, dirname = ?, basename = ?, extension = ?, filename = ?, hash = ?, filesize = ?', $fullpath , $dirname, $basename, $extension, $filename, $hash, $filesize);
        return $insert->affectedRows();
    }
    public function deleteAssetwithFullpath($fullpath){
        $this->database->query('UPDATE assets SET deleted = 1 WHERE fullpath = ?', $fullpath);
    }
}