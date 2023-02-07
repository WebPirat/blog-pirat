<?php
namespace helper;



class routeParser
{
    private array $siteinfo;
    private $uriarray;


    public function __construct($siteinfo)
    {
        $uriarray = $siteinfo['uriarray'];
        array_shift($uriarray);
        $this->siteinfo = $siteinfo;
        $this->uriarray = $uriarray;
    }

    public function compareRoutes($routefunction){
        if(count($routefunction) >= count($this->uriarray)){
            return true;
        }
    }
}