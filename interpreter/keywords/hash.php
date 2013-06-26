<?php

// hash:md5 string "my whole string goes in here and I can also \"escape\" special characters like this: \\"
// hash:sha256 $varName
// hash:sha1 file "filename.txt"

class hash implements keywords {
    private $error = NULL;    // we will store errors here

    public function error() {  // this will be called when some error is found
        return $this -> error;
    }

    public function syntax($string) {
        if(empty($string)) {  // too few arguments
             $this -> error .= "Syntax error: too few arguments. \"hash\" requires additional arguments.";
            return false;
        }
        return true;
    }
    public function run($string) {
        if $string[2] == "string" {
            return $string[1]($string[3]);
        } elseif $string[2] == "file" {
            return $string[1](readfile($string[3]));
        } else {
            return $string[1]($varName);
        }
    }
}
?>
