<?php

namespace Bootstrap;

/**
 * MenuControl
 *
 * Provides a menu control that applies Twiiter Bootstrap styles.
 * 
 */
class MenuControl extends \MenuControl {
	
	public function __construct($directory, $depth = 0) {
		parent::__construct($directory, $depth);
		$this->buildList(); // Generate dir structure.
	}
    private $legal = 0;
    function generateMenu(array $array, $baseUrl = '/')
    {
        $html = '<ul>';
        foreach ($array as $key => $item)
        {
            if (is_array($item) && $key !== 'Legal')
            {
                $html .= '<li>' . $key . '<ul>';
                $html .= Self::generateMenu($item, $baseUrl . $key . '/');
                $html .= '</ul></li>';
            }
            else
            {
                if ($key === 'Legal'){
                    $path = 'Legal/';
                    $page = new \Page('pages/'.$path);
                    $html .= '<li><a href="' . \Jade\Config::get('site.siteRoot') . "pages/" . strToLower($path) .'">'. 'Legal' .'</a></li>';
                    unset($page);
                }
                else{
                    $path =  \Jade\StringHelper::removeMD(trim($baseUrl.$item, '/'));
                    $page = new \Page('pages/'.$path);
                    $html .= '<li><a href="' . \Jade\Config::get('site.siteRoot') . "pages/" . strToLower($path) .'">'. $page->title .'</a></li>';
                    unset($page);
                }


            }
        }
        $html .= '</ul>';
        return $html;
    }

	public function display() {
        //print_r($this->getStructure()["pages"]);
        $nested_menu_array = $this->getStructure()["pages"];
        //echo $this->generateMenu($nested_menu_array);
        echo $this->generateMenu($nested_menu_array);
	}

}
