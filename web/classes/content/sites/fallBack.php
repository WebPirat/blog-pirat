<?php
namespace content\sites;

use models\content;

class fallBack
{
    public object $content;
    public int $siteID;

    public function __construct($sitesarray)
    {
        $this->content = new content();
        $this->siteID = $sitesarray['ID'];
    }



    public function get(){
        $articels = $this->content->getContent($this->siteID);
        echo '<div class="grid-2">';
        foreach ($articels as $articel){
            echo '<div>'.$articel['content'].'</div>';
        };
        echo '</div>';
    }
}