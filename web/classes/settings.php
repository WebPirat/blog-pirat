<?php
class settings
{
     private $database;
     public $settings;

     public function __construct()
     {
         $this->database = new db();
         $this->settings = $this->database->query('SELECT * FROM settings')->fetchAll();

     }

    /**
     * @return mixed
     */
    public function getSettings(): array
    {
        return $this->settings;
    }

    /**
     * @param mixed $settings
     */
    public function getOneSetting($name, $group = null): string
    {
        if($group !== null) {
            $catID = $this->database->query('SELECT * FROM settings_cat WHERE name = ?', $group)->fetchString('ID');
            $group = $catID;
        }
        $sql = $this->database->query('SELECT * FROM settings WHERE name = ? AND cat = ?', $name ,$group)->fetchString('content');
        if(empty($sql)){
            $response = 'Empty';
        }else{
            $response = $sql;
        }
        return $response;
    }
}