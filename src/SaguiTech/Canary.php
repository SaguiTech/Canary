<?php

namespace SaguiTech;

class Canary {
	private $inputFile, $outputFile, $contents;

	public function __construct() {
		global $argc, $argv;
		$this->inputFile = $argv[1];
		$this->outputFile = substr($argv[1], 0, strpos($argv[1], '.')).'.php';
		$this->contents = file_get_contents($this->inputFile);


		$this->bindVariables();
		$this->addSemiColons();
		$this->addOpenTag();

		$this->writeOut();
	}

	private function writeOut() {
		file_put_contents($this->outputFile, $this->contents);
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
}


/**
 * Simple ANSI Colors
 * Version 1.0.0
 * https://github.com/SimonEast/Simple-Ansi-Colors
 */
class Ansi {

	/**
	 * Whether colour codes are enabled or not
	 *
	 * Valid options:
	 *     null - Auto-detected.  Color codes will be enabled on all systems except Windows, unless it
	 *            has a valid ANSICON environment variable
	 *            (indicating that AnsiCon is installed and running)
	 *     false - will strip all tags and NOT output any ANSI colour codes
	 *     true - will always output color codes
	 */
	public static $enabled = null;

	public static $tags = array(
		'<black>'       => "\033[0;30m",
		'<red>'         => "\033[1;31m",
		'<green>'       => "\033[1;32m",
		'<yellow>'      => "\033[1;33m",
		'<blue>'        => "\033[1;34m",
		'<magenta>'     => "\033[1;35m",
		'<cyan>'        => "\033[1;36m",
		'<white>'       => "\033[1;37m",
		'<gray>'        => "\033[0;37m",
		'<darkRed>'     => "\033[0;31m",
		'<darkGreen>'   => "\033[0;32m",
		'<darkYellow>'  => "\033[0;33m",
		'<darkBlue>'    => "\033[0;34m",
		'<darkMagenta>' => "\033[0;35m",
		'<darkCyan>'    => "\033[0;36m",
		'<darkWhite>'   => "\033[0;37m",
		'<darkGray>'    => "\033[1;30m",
		'<bgBlack>'     => "\033[40m",
		'<bgRed>'       => "\033[41m",
		'<bgGreen>'     => "\033[42m",
		'<bgYellow>'    => "\033[43m",
		'<bgBlue>'      => "\033[44m",
		'<bgMagenta>'   => "\033[45m",
		'<bgCyan>'      => "\033[46m",
		'<bgWhite>'     => "\033[47m",
		'<bold>'        => "\033[1m",
		'<italics>'     => "\033[3m",
		'<reset>'       => "\033[0m",
	);

	/**
	 * This is the primary function for converting tags to ANSI color codes
	 * (see the class description for the supported tags)
	 *
	 * For safety, this function always appends a <reset> at the end, otherwise the console may stick
	 * permanently in the colors you have used.
	 *
	 * @param string $string
	 * @return string
	 */
	public static function tagsToColors($string)
	{
		if (self::$enabled === null) {
			self::$enabled = !self::isWindows() || self::isAnsiCon();
		}

		if (!self::$enabled) {
			// Strip tags (replace them with an empty string)
			return str_replace(array_keys(self::$tags), '', $string);
		}

		// We always add a <reset> at the end of each string so that any output following doesn't continue the same styling
		$string .= '<reset>';
		return str_replace(array_keys(self::$tags), self::$tags, $string);
	}

	public static function isWindows()
	{
		return strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
	}

	public static function isAnsiCon()
	{
		return !empty($_SERVER['ANSICON'])
			&& substr($_SERVER['ANSICON'], 0, 1) != '0';
	}

}