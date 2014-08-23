<?php

namespace SaguiTech;

class Canary {
	
	private $inputFile, $outputFile, $contents;	

	public function run($inputFile) {
		$this->inputFile = $inputFile;
		$this->outputFile = substr($this->inputFile, 0, strpos($this->inputFile, '.')).'.php';
		$this->contents = file_get_contents($this->inputFile);

		$this->bindVariables($this->contents);
		$this->addSemiColons($this->contents);
		$this->addOpenTag($this->contents);	
		
		return $this->contents;	
	}

	public function writeOut() {
		return file_put_contents($this->outputFile, $this->contents);
	}

	public function bindVariables($contents) {
		$callback = function($matches) {
			$except = ['if','else', 'elseif'];
			if(in_array($matches[1], $except))
				return $matches[0];
			return '$'.$matches[0];
		};
		return $this->contents = preg_replace_callback('/([a-zA-Z]{1}[a-zA-Z0-9]*)(?:\s*?)(?:=|\||\+|-|\*|\/|\)|\.|$|;|<|>)/m', $callback, $contents);
	}

	public function addSemiColons($contents) {
		$callback = function($matches) {
			return $matches[0].';';
		};				
		return $this->contents = preg_replace_callback('/^(.*)(\'|"|[0-9]|\])$/m', $callback, $contents);
	}

	public function addOpenTag($contents) {
		return $this->contents = "<?php\n".$contents;
	}

	public function getOutputFile()	{
		return $this->outputFile;
	}

}