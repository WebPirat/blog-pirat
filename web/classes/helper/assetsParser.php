<?php
namespace helper;

use core\settings;
use modals\assets;

class assetsParser
{
    private object $arrayParser;
    private object $fileParser;
    private object $assetsModal;
    private object $settings;

    public function __construct()
    {
        $this->fileParser = new fileParser();
        $this->arrayParser = new parseArray();
        $this->settings = new settings();
        $this->assetsModal = new assets();
        print_r($this->saveAllAssets());
    }

    public function getSettings()
    {
        return $this->settings->getAllSettingsFromCat('assets');
    }

    public function scanAllAssets(): array
    {
        $allFiles = $this->fileParser->getDirContents('/assets');
        $allAssets = [];
        foreach ($allFiles as $file){
            $info = pathinfo($file);
            $assets['fullpath'] = $file;
            $assets['dirname'] = $info['dirname'];
            $assets['basename'] = $info['basename'];
            $assets['extension'] = $info['extension'];
            $assets['filename'] = $info['filename'];
            $assets['filesize'] = $this->fileParser->getFileSize($file);
            $assets['hash'] = $this->fileParser->hashFile($file);
            $allAssets[] = $assets;
        }
        return $allAssets;
    }
    private static function invenDescSort($item1,$item2)
    {
        if ($item1['fullpath'] == $item2['fullpath']) return 0;
        return ($item1['fullpath'] < $item2['fullpath']) ? 1 : -1;
    }
    public function saveAllAssets(){
        $dbAssets = $this->assetsModal->allAssets;
        $fileAssets = $this->scanAllAssets();
        if(empty($dbAssets)){
            foreach ($fileAssets as $asset){
               $this->assetsModal->saveAsset($asset['fullpath'], $asset['dirname'], $asset['basename'], $asset['extension'], $asset['filename'], $asset['hash'], $asset['filesize']);
            }
        }else{
            usort($dbAssets, function ($a, $b) {
                if ($a['fullpath'] == $b['fullpath']) {
                    return 0;
                }

                return ($a['fullpath'] < $b['fullpath']) ? -1 : 1;
            });
            usort($fileAssets, function ($a, $b) {
                if ($a['fullpath'] == $b['fullpath']) {
                    return 0;
                }

                return ($a['fullpath'] < $b['fullpath']) ? -1 : 1;
            });
            $compare = $this->arrayParser->compareArrays($dbAssets, $fileAssets);

            /**
             * more files then db entrys
             */
            if(!empty($compare['changes'])){
                foreach ($compare['changes'] as $asset){
                    $this->assetsModal->updateAsset($asset['fullpath'], $asset['dirname'], $asset['basename'], $asset['extension'], $asset['filename'], $asset['hash'], $asset['filesize']);
                }
            }
            exit;
            /**
             * more db entrys then files entrys
             */
            if(!empty($compare['more'])){
                foreach ($compare['more'] as $asset){
                    $this->assetsModal->deleteAssetwithFullpath($asset['fullpath']);
                }
            }


            /**
             * more files then db entrys
             */
            if(!empty($compare['new'])){
                foreach ($compare['less'] as $asset){
                    $this->assetsModal->saveAsset($asset['fullpath'], $asset['dirname'], $asset['basename'], $asset['extension'], $asset['filename'], $asset['hash'], $asset['filesize']);
                }
            }
        }
    }

}