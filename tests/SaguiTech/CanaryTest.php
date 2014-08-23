<?php

namespace Test\SaguiTech;

use Test\AbstractTest,
		SaguiTech\Canary;

class CanaryTest extends AbstractTest
{

	protected $canary;

	public function setUp($inputFile = 'file.cap')
	{
		$this->canary = new Canary;
	}

	public function testRun($inputFile = 'examples/file.cap', $outputFile = 'examples/file.php')
	{		
		$this->assertTrue(file_exists($inputFile));
		$this->assertTrue(file_exists($outputFile));
		$contentsOutput = file_get_contents($outputFile);		
		$this->assertEquals($contentsOutput, $this->canary->run($inputFile));
	}

	public function testBindVariables($contents = "foo = 'bar';")
	{
		$this->assertEquals("\$foo = 'bar';", $this->canary->bindVariables($contents));
	}

	public function testAddSemiColons($contents = "\$foo = 'bar'\n\$bar = 'foo'")
	{
		$this->assertEquals("\$foo = 'bar';\n\$bar = 'foo';", $this->canary->addSemiColons($contents));
	}

	public function testAddOpenTag($contents = "echo 'Hello World'")
	{
		$this->assertEquals("<?php\necho 'Hello World'", $this->canary->addOpenTag($contents));
	}

}