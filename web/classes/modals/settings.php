<?php
namespace modals;
use core\db;

class settings
{
    private object $DB;
    public array $allSettings;
    public array $allSettingsCat;

    public function __construct()
    {
        $this->DB = new db();
    }

    /**
     * @return array
     */
    public function getAllSettings(): array
    {
        $this->allSettings = $this->DB->query('SELECT * FROM settings')->fetchAll();
        return $this->allSettings;
    }

    /**
     * @return array
     */
    public function getAllSettingsCat(): array
    {
        $this->allSettingsCat = $this->DB->query('SELECT * FROM settings_cat')->fetchAll();
        return $this->allSettingsCat;
    }

}