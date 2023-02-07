<?php
namespace core;
use content\body;
use content\footer;
use content\header;
use helper\routeParser;
use models\hits;
use models\sites;

class router
{
    private object $hits;
    private object $body;
    private object $header;
    private object $footer;
    private object $uriclass;
    private object $routerParser;
    private string $uri;
    private settings $settings;
    private sites $sites;
    public array $siteinfo;

    public function __construct()
    {
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->uriclass = new uri();
        $this->settings = new settings();
        $this->sites = new sites();
        $this->siteinfo = $this->getSiteInfo();
        $this->hits = new hits($this->siteinfo);
        $this->header = new header($this->siteinfo);
        $this->body = new body($this->siteinfo);
        $this->footer = new footer($this->siteinfo);
    }

    private function getHeaderMeta(): array
    {
        $meta['title'] = $this->settings->getOneSetting('title', 'meta');
        return $meta;
    }
    private function getSiteInfo(): array
    {
        $siteinfo = [];

        $siteinfo['homeID'] = $this->settings->getOneSetting('home');
        $siteinfo['title'] = $this->settings->getOneSetting('title', 'meta');
        $siteinfo['uri'] = $this->uriclass->getUri();
        $siteinfo['uriarray'] = $this->uriclass->getUriArray($this->uri);

        return $siteinfo;
    }
    public function route(): void
    {
        $this->hits->addHits($this->uri);
        $this->header->get($this->getHeaderMeta());
        $this->body->get();
        $this->footer->get();
    }
}
