<? 
require_once 'interface.class.php';
require_once 'parser.class.php';

class xitram{
	public $error = NULL; //All errors in code are saved here
	private $commands = array(); //All objects will be stored here
	private $arguments = array(); //Command arguments will be stored here
	private $lines = NULL; //Number of lines that the code has
	
	//Loading the code, making sure it has no syntax errors,
	private function load($code){
		$parser = new parser;		
		$code = $parser->parse($code);
		
		$code_line = 0; // For bug on line reporting
		$code_error = NULL; //All the errors will be saved here

		foreach($code as $line){
			$code_line++; //Moving to the next line
			//$line = explode(' ', trim($code[$code_line - 1]), 2); // We need just the first word on each line.

			if(empty($line[1])) $line[1] = NULL; //In-case we don't have an extra argument
			
			if(ctype_alnum($line[0])){
				if(file_exists(dirname(__FILE__).'/keywords/'.$line[0].'.php')){
					require_once dirname(__FILE__).'/keywords/'.$line[0].'.php';
					$this->commands[$code_line -1] = new $line[0]; //Creating object for the line
					if($this->commands[$code_line -1]->syntax($line[1]) != 'true'){
						 $code_error .= 'Error near: \''.$line[0].'\' on line: '.$code_line.' - '.$this->commands[$code_line -1]->error().'<br/>';
					}
					$this->arguments[$code_line -1] = $line[1]; // Adding arguments for this line
				}
				else $code_error .= 'Syntax error near: \''.$line[0].'\' on line: '.$code_line.' - \'Unknown command\'<br/>';			
				
			}
			else {	
				if(!empty($line[0])) $code_error .= 'Syntax error near: \''.$line[0].'\' on line: '.$code_line.' - \'Command must be alphanumeric\'<br/>';
				else $code_line -= 1; //If there is a trailing ; remove the line     
			     }	
		}
		$this->error = $code_error;
		$this->lines = $code_line;
	}
	
	//Cleaning the variables, so they don't interfere with execution of new code
	private function clean(){
		$this->error = NULL;
		$this->commands = NULL;
		$this->arguments = NULL;
		$this->lines = NULL;
	}
	//Checking the syntax
	public function syntax($code){
		$this->load($code);
		if(!empty($this->error)) $return = "Some errors were found: <p>{$this->error}</p>";
		else $return = "No errors were found!";
		$this->clean();
		return $return;
	}			
	//Executing the code
	public function execute($code){
		$this->load($code);
		if(!empty($this->error)) die($this->error);	
		for($temp = 0;$temp < $this->lines; $temp++) $this->commands[$temp]->run($this->arguments[$temp]);
		$this->clean();
	}
} 
?>
