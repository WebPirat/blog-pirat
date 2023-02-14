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
     }

     public  function getAllSettingsFromCat($group){
         $id = $this->getGroupId($group);
         $settings = $this->parseArray->findInArray($this->allSettings, ['cat' => $id]);
         foreach ($settings as $setting){
             $response[$setting['name']] = $setting['content'];
         }
         return $response;
     }

     public function getGroupId($group){
         return $this->parseArray->findSingleInArray($this->allSettingsCat, ['name' => $group], 'ID');
     }
    /**
     * @param mixed $settings
     */
    public function getOneSetting($name, $group = NULL): string
    {
        $needle['name'] = $name;
        if(!empty($group)){
            $groupName = $this->getGroupId($group);
            $needle['cat'] = $groupName;
        }
        return $this->parseArray->findSingleInArray($this->allSettings, $needle, 'content');
    }
}