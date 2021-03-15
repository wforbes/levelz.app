<?php

namespace Http;

class Get {
	public $url_elements, $url_element_count, $parameters;

    public function __construct($app)
    {
        $parsed_url = @parse_url($_SERVER['REQUEST_URI']);
        $this->setUrlElementsFromPath($parsed_url);
        $this->url_element_count = count($this->url_elements);
        $this->setParametersFromQuery($parsed_url);
        $this->routeRequest($app, $app->dlm);
	}
	
	private function routeRequest($app, $d){
		//echo json_encode("Http GET method test was successful!");
		echo json_encode([$this->url_elements, $this->parameters]);
	}

	//name: setParametersFromQuery
    //desc: takes the parsed_url array and if it has a query index
    //      if parses the query string into the parameters class member
    private function setParametersFromQuery(array $parsed_url):void
    {
        if(isset($parsed_url['query'])){
            parse_str($parsed_url['query'],$this->parameters);
        }
    }
    //name: setUrlElementsFromPath
    //desc: takes the parsed_url array and if it has a path index
    //      it creates an array from that string and clears any
    //      empty elements, then if there are any elements left in
    //      the array it adds each item to the url_elements class
    //      member array
    private function setUrlElementsFromPath(array $parsed_url):void
    {
        if(isset($parsed_url['path']) && $parsed_url['path'] != '/'){
            $_ue = explode('/',$parsed_url['path']);
            if($_ue[0]==='')
                $_ue = $this->clearEmptyElements($_ue);
            if(count($_ue)>0) {
                foreach ($_ue as $k => $v) {
                    $this->url_elements[$k] = $v;
                }
            }
        }else{
            $this->url_elements = [""];
        }
    }

    //name: clearEmptyElements
    //desc: takes in a non-associative array checks if each of its elements
    //      is not an empty string, if they pass they are added to new array
    //      when finished checking return the new array
    public static function clearEmptyElements(array $a):array
    {
        $b = [];
        foreach($a as $k=>$v){
            if($v!==''){
                $b[] = $a[$k];
            }
        }
        return $b;
    }
}