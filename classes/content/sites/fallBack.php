<?php
namespace content\sites;

use models\content;

class fallBack
{
    public object $content;
    public int $siteID;
    private object $routeParser;

    public function __construct($sitesarray)
    {
        $this->content = new content();
        $this->siteID = $sitesarray['ID'];
    }

    public function routes(){
        return ['site_alias'=> 'blog_entrys'];
    }

    public function get(){
        $articels = $this->content->getContent($this->siteID);
        echo '<div class="grid-2">';
        foreach ($articels as $articel){
            echo '<div>'.$articel['content'].'3</div>';
        };
        echo '</div>';
    }
}