<?php
class readf implements keywords {
    private $error = NULL;    // we will store errors here

    public function error() {  // this will be called when some error is found
        return $this -> error;
    }

    public function syntax($string) {
        if(empty($string)) {  // too few arguments
             $this -> error .= "Syntax error: too few arguments. \"readf\" requires additional arguments.";
            return false;
        }
        return true;
    }
    public function run($string) {
        $string = implode($string);
        readfile($string);
    }
}
?>
