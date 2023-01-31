<?php
namespace content;
require_once ('autoloader.php');

class body
{
    private $uri;
    private $database;
    private $settings;
    private $homeID;
    private $navID;
    private $sites;
    public $widgets;

    public function __construct()
    {
        $this->database = new \core\db();
        $this->settings = new \core\settings();
        $this->sites = new \models\sites();
        $this->uri = $_SERVER['REQUEST_URI'];
    }



    /**
     * @return settings
     */
    public function getWidgets(): array
    {

        return $this->widgets;
    }

    public function get(){
        echo '<body class="container">';
        echo 'Yolo';
        echo '</body>';
    }
}