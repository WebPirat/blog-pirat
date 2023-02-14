<?php
namespace helper;


class fileParser
{
    public function getDirContents($dir, &$results = array()) {
    $rootFolder = $_SERVER['DOCUMENT_ROOT'];
    if(!str_contains($dir, $_SERVER['DOCUMENT_ROOT'])){
        $dir = $rootFolder . $dir;
    }
    $files = scandir($dir);
        foreach ($files as $value) {
                $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
                if (!is_dir($path)) {
                    $results[] = str_replace($rootFolder, '' , $path);
                } else if ($value != "." && $value != "..") {
                    $this->getDirContents($path, $results);
                }
        }
    return $results;
    }

    public function countDirContents($dir, &$results = 0) {
        $rootFolder = $_SERVER['DOCUMENT_ROOT'];
        if(!str_contains($dir, $_SERVER['DOCUMENT_ROOT'])){
            $dir = $rootFolder . $dir;
        }
        $files = scandir($dir);
        foreach ($files as $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results++;
            } else if ($value != "." && $value != "..") {
                $this->countDirContents($path, $results);
            }
        }
        return $results;
    }

    public function hashFile($fileName){
        $rootFolder = $_SERVER['DOCUMENT_ROOT'];
        $fileName = $rootFolder . $fileName;
         if(!file_exists($fileName)) {
             die("Helper : FILEPARSER '".$fileName."' File not found!");
         }
        $ctx = hash_init('sha256');

        $file = fopen($fileName, 'r');
        while(!feof($file)){
            $buffer = fgets($file, 1024);
            hash_update($ctx, $buffer);
        }

        return hash_final($ctx);
    }

    public function compareHash($fileName, $hash): bool
    {
        $newhash = $this->hashFile($fileName);
        return $newhash == $hash;
    }

    public function getFileSize($filename): string
    {
        return filesize($_SERVER['DOCUMENT_ROOT'].$filename);
    }
}