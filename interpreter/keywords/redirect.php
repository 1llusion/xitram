<?php

// redirect "http://google.com"

class redirect implements keywords{
  private $error = NULL;		// we will store errors here

	public function error(){	// this will be called when some error is found
		return $this->error;
	}

	public function syntax($string){
		// when no arguments are specified window location doesn't change
		return true;
	}
	public function run($string){	// we are redirecting the document's location to the new (if there's any) location specified anything found after the command
    $string = implode($string);
		header("Location:" . $string);
	}
}

?>
