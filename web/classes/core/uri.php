<?php
namespace core;

require_once ('autoloader.php');

class uri
{
    public string|false $firstUri;
    private string $uri;
    private settings $settings;

    public function __construct()
    {
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->firstUri = $this->getFirstRoute($this->uri);
        $this->settings = new settings();

    }

    public function getFirstRoute($uri): bool|string
    {
        $uriarray = array_filter(explode('/', $uri));
        return $uriarray[1] ?? false;
    }
    public function getUriArray($uri): array
    {
        return  array_filter(explode('/', $uri));
    }
    private function getLastUri($uri): string
    {
        $uriarray = array_filter(explode('/', $uri));

        return $uriarray[count($uriarray)];
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }
}
