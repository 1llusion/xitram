<?php

/*

Read local or remote file.
Examples:

getf "localfile.txt"
getf "http://www.example.com/textfile.txt"
getf "http://www.example.com/getsourcecodeofthispage.html"

-------------------
- getf "file.txt" -
-------------------

read file.txt and return it as string

------------------------------------
- getf as_array arrName "file.txt" -
------------------------------------

read file.txt and set its content to the array arrName

----------------------------------
- getf as_var varName "file.txt" -
----------------------------------

read file.txt and set its content to the variable varName

*/

class getf implements keywords {
    private $error = NULL;    // we will store errors here

    public function error() {  // this will be called when some error is found
        return $this -> error;
    }

    public function syntax($string) {
        if(empty($string)) {  // too few arguments
             $this -> error .= "Syntax error: too few arguments. \"getf\" requires additional arguments.";
            return false;
        }
        return true;
    }
    public function run($string) {
        if $string[1] == as_array {
            $arrName = $string[2];
            unset($string[1]);
            unset($string[2]);
            $string = implode($string);
            $$arrName = file($string);
        }
        if $string[1] == as_var {
            $varName = $string[2];
            unset($string[1]);
            unset($string[2]);
            $string = implode($string);
            $$varName = file_get_contents($string);
        }
    }
}
?>
