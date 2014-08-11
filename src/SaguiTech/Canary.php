<?php

namespace SaguiTech;

class Canary {
	private $inputFile, $outputFile, $contents;

	public function __construct($inputFile = null) {
		global $argc, $argv;
		$this->inputFile = isset($inputFile) && !empty($inputFile) ? $inputFile : $argv[1];
		$this->outputFile = substr($this->inputFile, 0, strpos($this->inputFile, '.')).'.php';
		$this->contents = file_get_contents($this->inputFile);

		$this->bindVariables();
		$this->addSemiColons();
		$this->addOpenTag();
	}

	public function writeOut() {
		return file_put_contents($this->outputFile, $this->contents);
	}

	private function bindVariables() {
		$callback = function($matches) {
			$except = ['if','else', 'elseif'];
			if(in_array($matches[1], $except))
				return $matches[0];
			return '$'.$matches[0];
		};
		$this->contents = preg_replace_callback('/([a-zA-Z]{1}[a-zA-Z0-9]*)(?:\s*?)(?:=|\||\+|-|\*|\/|\)|\.|$|;|<|>)/m', $callback, $this->contents);
	}

	private function addSemiColons() {
		$callback = function($matches) {
			return $matches[0].';';
		};
		$this->contents = preg_replace_callback('/^(.*)(\'|"|[0-9]|\])$/m', $callback, $this->contents);
	}

	private function addOpenTag() {
		$this->contents = "<?php\n".$this->contents;
	}

	public function getOutputFile()
	{	return $this->outputFile;
	}

}