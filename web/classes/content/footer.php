<?php
namespace content;
use core\settings;
use core\uri;
use helper\textParser;
use models\sites;

require_once ('autoloader.php');

class footer
{
    private $textparser;
    private $settings;
    private $uri;
    private $sites;
    public $footerNav;

    public function __construct()
    {
        $this->textparser = new textParser();
        $this->sites = new sites();
        $this->uri = new uri();
        $this->settings = new settings();
        $this->getFooterNav();
    }

    /**
     * @return mixed
     */
    public function getFooterNav(): void
    {
        $nav = $this->sites->getSitesforFooter();
        $home = $this->settings->getOneSetting('home');
        $firstUri = $this->uri->firstUri;
        $this->footerNav = '<ul class="footer-ul">';
        foreach ($nav as $link){
            $aktiv = '';
            if($link['ID'] == $home && empty($firstUri)){
                $aktiv = ' active';
            }
            if(strtolower($link['site_alias']) == strtolower($firstUri)){
                $aktiv = ' active';
            }
            $this->footerNav .= '<li class="footer-li'.$aktiv.'"><a href="'.$link['site_alias'].'">'.$link['name'].'</a></li>';
        }
        $this->footerNav .= '</ul>';
    }

    public function get(){
        echo '<footer>
                <div class="footer">
                    <div class="footer-left">'.$this->textparser->getText('copyright').'</div>
                    <nav class="footer-nav">
                        '.$this->footerNav.'
                    </nav>               
                </div>
              </footer>
               </body>';
        echo '</html>';
    }
}