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
		$this->assertEquals($this->canary->run($inputFile), $contentsOutput);
	}

	public function testBindVariables($contents = "foo = 'bar';")
	{
		$this->assertEquals($this->canary->bindVariables($contents), "\$foo = 'bar';");
	}

	public function testAddSemiColons($contents = "\$foo = 'bar'\n\$bar = 'foo'")
	{
		$this->assertEquals($this->canary->addSemiColons($contents), "\$foo = 'bar';\n\$bar = 'foo';");
	}

	public function testAddOpenTag($contents = "echo 'Hello World'")
	{
		$this->assertEquals($this->canary->addOpenTag($contents), "<?php\necho 'Hello World'");
	}

}