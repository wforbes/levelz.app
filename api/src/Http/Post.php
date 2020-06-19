<?php

namespace Http;

use Core\App;

class Post {
	private $app;
	private $dataKey = "data";
	private $nounKey = "n";
	private $verbKey = "v";
	private $inputData;
	private $scriptVerbs = [];
	private $nounName;
	private $nounNamespace;
	private $nounClass;
	private $verbName;
	private $payload;
	/* array for allowList on operations clients can call
		Currently allowList is just 'public' functions
	private $nounVerbArray = [
		"Auth" => ["signup"],

	];
	*/
	public function __construct($app)
    {
		$this->app = $app;
        $this->setInputData();
		$this->parseNounScript();
		$this->instantiateNounClass();
		$this->verbName = filter_var($this->inputData[$this->verbKey], FILTER_SANITIZE_STRING);
		$this->payload = $this->parseNonNVData();
		$result = $this->doVerb($this->verbName, $this->payload);

        Post::reply($result);
        exit();
    }

	public static function reply($s) {
        echo json_encode((is_array($s))?($s):([$s]));
	}
	
	//name: setInputData
	//desc: Populates the inputData class member from incoming data. 
	//	Check for data in Post array at dataKey, use that if not empty.
	//	Then check php://input stream, use that if data was received there.
	//https://stackoverflow.com/questions/8893574/php-php-input-vs-post
	public function setInputData() {
		if (empty($_POST[$this->dataKey])) {
			$input = file_get_contents("php://input");
            if ($input) {
				$json = json_decode($input, true);
				$this->inputData = $_POST[$this->dataKey] = $json[$this->dataKey];
			} else {
				//TODO: error - No data provided to Post
			}
        } else {
			$this->inputData = $_POST[$this->dataKey];
		}
	}

	private function parseNounScript() {
		//TODO: check if nounKey directly refers to a nounName or a translation is needed
		if (!\is_array($this->inputData[$this->nounKey])) {
			$this->nounName = ucFirst(
				filter_var($this->inputData[$this->nounKey], FILTER_SANITIZE_STRING)
			);
			$this->nounNamespace = $this->nounName; 
		} else {
			if (\count($this->inputData[$this->nounKey]) === 2) {
				$this->nounNamespace = ucfirst(
					filter_var($this->inputData[$this->nounKey][0], FILTER_SANITIZE_STRING)
				);
				$this->nounName = ucfirst(
					filter_var($this->inputData[$this->nounKey][1], FILTER_SANITIZE_STRING)
				);
			} else {
				//TODO: error - Incorrect number of nouns provided to Post
			}
		}
		
		$scriptMethods = $this->getMethodsFromScript(
			App::APP_ROOT."/".$this->nounNamespace."/".$this->nounName.".php"
		);
		foreach($scriptMethods[$this->nounName] as $verb) {
			$this->scriptVerbs[] = $verb;
		}
	}

	//name: getMethodsFromScript
	//desc: Gets the method names in a php source file given the filePath,
	//	uses an optional onlyPublic flag (default to true) which restricts
	//	to only methods with 'public' access modifiers
	//https://stackoverflow.com/questions/928928/determining-what-classes-are-defined-in-a-php-class-file
	//https://stackoverflow.com/a/4068490
	private function getMethodsFromScript($filePath, $onlyPublic=true):array {
		$fileContents = file_get_contents($filePath);
		//TODO: check if file/class is not allowed
		if ($fileContents === false) {
			//TODO: error - Could not find source file
		} else {
			$methods = array();
			$tokens = token_get_all($fileContents);
			$count = \count($tokens);
			for ($i = 2; $i < $count; $i++) {
				if ($tokens[$i - 2][0] === T_CLASS
					&& $tokens[$i - 1][0] === T_WHITESPACE
					&& $tokens[$i][0] === T_STRING
				) {
					$class_name = $tokens[$i][1];
					$methods[$class_name] = array();
				}
				if ($tokens[$i - 2][0] === T_FUNCTION
					&& $tokens[$i - 1][0] === T_WHITESPACE
					&& $tokens[$i][0] === T_STRING
				) {
					if ($onlyPublic) {
						if (!\in_array($tokens[$i-4][0],array(T_PROTECTED, T_PRIVATE), true)) {
							$method_name = $tokens[$i][1];
							$methods[$class_name][] = $method_name;
						}
					} else {
						$method_name = $tokens[$i][1];
						$methods[$class_name][] = $method_name;
					}
				}
			}
			return $methods;
		}
	}

	private function instantiateNounClass() {
        $class = "\\".$this->nounNamespace."\\".$this->nounName;
        $this->nounClass = new $class($this->app);
	}
	
	private function parseNonNVData() {
        $d = [];
        foreach($this->inputData as $k=>$v){
            if($k!=='n'||$k!=='v'){
                $d[$k] = $v;
            }
        }
        return $d;
	}
	
	private function doVerb($v, $d){
        return $this->nounClass->$v($d);
    }
}