<?php

class Page {
    public $header = '';
    public $title = '';
  	public $content = '';
  	public $markdown = '';
  	public $file = NULL;
    public $post_type = '';

	public function __construct($article_name) {

		if (self::pageExists($article_name)) {
            echo "Checking page... ${article_name}";
			$parser = new \Michelf\MarkdownExtra;
			// Apply Markdown settings
			$parser->empty_element_suffix = \Jade\Config::get('markdown.empty_element_suffix', ' />');
			$parser->tab_width = \Jade\Config::get('markdown.tab_width', 4);
			$parser->no_markup = \Jade\Config::get('markdown.no_markup', FALSE);
            $parser->no_entities = \Jade\Config::get('markdown.no_entities', FALSE);
            $parser->predef_urls = \Jade\Config::get('markdown.predef_urls', array());
            $parser->predef_titles = \Jade\Config::get('markdown.predef_titles', array());
            $parser->fn_id_prefix = \Jade\Config::get('markdown.fn_id_prefix', '');
            $parser->fn_link_title = \Jade\Config::get('markdown.fn_link_title', '');
			$parser->fn_backlink_title = \Jade\Config::get('markdown.fn_backlink_title', '');
			$parser->fn_link_class = \Jade\Config::get('markdown.fn_link_class', '');
            $parser->fn_backlink_class = \Jade\Config::get('markdown.fn_backlink_class', '');
			$parser->code_class_prefix = \Jade\Config::get('markdown.code_class_prefix', '');
			$parser->code_attr_on_pre = \Jade\Config::get('markdown.code_attr_on_pre', FALSE);
			$parser->predef_abbr = \Jade\Config::get('markdown.predef_abbr', array());


            $data = file_get_contents(self::prepareFileName($article_name));
			$dat = new SplFileInfo(self::prepareFileName($article_name));

			$this->file = $dat;

			$markdown_data = '';


        $post = array();
        $matches = array();
        $get_header_tags = preg_grep('/[A-Z].*:.*/', explode("\n", $data));


        /*
         * TODO: Map the tags name before the colon to
         * the array key.
         */
        foreach($get_header_tags as $ele) {
            $a = preg_split("/[\s{1}]/", $ele, 2);
            $kv = $this->array2KV($a);
            array_push($post, $kv);
        }
        $post_modi["post_content"] = $this->parseContentFromMd($data);

        $content = $parser->transform($post_modi["post_content"]);
        $post_modi['post_content'] = $content;

            $this->header = $this->_arr2KV($post);
            $this->title = $this->header["Title"];
			$this->content = $parser->transform($post_modi['post_content']);
			$this->markdown = $markdown_data;

		}
	}

	public function getContent() {
		return $this->content;
	}

	public function getFile() {
		return $this->file;
	}

	public function __get($index) {
		if (isset($this->custom_data[$index])) {
			return trim($this->custom_data[$index]);
		} else {
			return '';
		}
	}

    /**
        Array
        (
            [title] => Jade CMS for PHP 1.2
            [desc] => Changes that will be made in Jade CMS for PHP 1.2
            [author] => Paradox One LLC
            [categories] => Array
                (
                    [0] => Jade CMS for PHP
                    [1] => Updates
                )

            [sticky] => true
        )

    */
	public function getCustomData() {
		return $this->header;
	}

	static public function pageExists($article_name) {
		$path = self::prepareFileName($article_name);
		if (file_exists($path) && is_readable($path)) {
			return TRUE;
		}
		return FALSE;
	}

	static public function prepareFileName($article_name) {
    // echo __CONTENT_LOCATION.$article_name.'.md';
		//$path = __CONTENT_LOCATION.'pages/'.$article_name.'.md';
		$path = __CONTENT_LOCATION.$article_name.'.md';
		return $path;
	}

	// These functions exist exclusively for the plugin system.
	static public function getScripts() {
		\Jade\Plugins::$pluginInstance->runHooks('scriptsRequested');
	}

	static public function getStyles() {
		\Jade\Plugins::$pluginInstance->runHooks('stylesRequested');
	}

    private function mapHeaderTags($tag) {
   
       switch($tag) { 
          case "Date:":
              $newTag = "post_date";              
          break; 
          case "Title:":
              $newTag = "post_title";
          break;
              
          case "Tags:":
              $newTag = "post_tags";
          break;
          case "Category:":
              $newTag = "post_category";
          break;
          case "Permalink:":
              $newTag = "post_name";
          break;
          case "PostType:":
              $newTag = "post_type";
          break;        
          default:
              $newTag = "post_content";
       }
       
       return $newTag;
    }
    // TODO: Move to helper class
    private function flattenArr($arr) {
        $new_arr = array();
        for($i=0; $i < count($arr); $i++) {
            $new_arr[$arr[$i][0]] = $arr[$i][1];
        }   
            
        return $new_arr;
    }
    
    /**
     * Takes and array with 2 pre-defined 
     * values and converts to key value 
     * array.
     *
    */
    private function array2KV($arr){
        $hash = [];
        $key = str_replace(":", "", $arr[0]);

        $hash[$key] = (isset($arr[1])) ? $arr[1] : "";
        return $hash;
    }

    /**
     * Converts array to hashmap
     *
    */
    private function _arr2KV($arr) {
        $hash = [];
        for($i=0; $i < count($arr); $i++) {
            foreach($arr[$i] as $k => $v) {
                $hash[$k] = $v;
            }
        }
        return $hash;
    }

    /**
     * Extracts body content from the
     * md file.
     * 
     */
    private function parseContentFromMd($data) {
        $pattern = array();
        $pattern[0] = '/[A-Z].*:.*/';
        $replace = array();
        $placeholder = array();
        $modified_content = preg_replace($pattern, $replace, $data);
        return $modified_content;
    }
}
