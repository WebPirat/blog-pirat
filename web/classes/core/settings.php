<?php
namespace core;
use helper\parseArray;

class settings
{
     private object $settings;
     private object $parseArray;
     public $allSettings;
     public $allSettingsCat;

     public function __construct()
     {
         $this->settings = new \modals\settings();
         $this->parseArray = new parseArray();
         $this->allSettings = $this->settings->getAllSettings();
         $this->allSettingsCat = $this->settings->getAllSettingsCat();
         echo $this->getOneSetting('footerID');
     }

    /**
     * @param mixed $settings
     */
    public function getOneSetting($name, $group = NULL): string
    {
        $needle['name'] = $name;
        if(!empty($group)){
            $groupName = $this->parseArray->findSingleInArray($this->allSettingsCat, ['name' => $group], 'ID');
            $needle['cat'] = $groupName;
        }
        return $this->parseArray->findSingleInArray($this->allSettings, $needle, 'content');
    }
}