<?php
namespace helper;



use core\settings;
use modals\sites;

class routeParser
{
    public array $siteinfo;
    private array $uriarray;
    private object $settings;
    private object $sites;
    private string $uri;


    public function __construct()
    {
        $this->settings = new settings();
        $this->sites = new sites();

        $this->uri = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
        $this->siteinfo = $this->getSiteinfo();
    }

    public function compareRoutes($routefunction){
        if(count($routefunction) >= count($this->uriarray)){
            return true;
        }
    }

    /**
     * @return object
     */
    public function getSiteinfo(): array
    {
        $siteinfo['title'] = $this->settings->getOneSetting('title');
        $siteinfo['uri'] = $this->uri;

        return $siteinfo;
    }

    public function getSiteTitle(): string
    {
        return $this->uri;
    }

    /**
     * @return string
     */
    public function doMagicShit(): string
    {
        return $this->uri;
    }
}