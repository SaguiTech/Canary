<?php

namespace SaguiTech\Console\Command;

use SaguiTech\Canary;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class WriteOutCommand extends Command
{

	protected function configure()
	{
		$this
			->setName('run')
			->setDescription('Write out the PHP file based input file')
			->addArgument('inputFile', InputArgument::REQUIRED, 'Does path file do you want to convert?');
	}

	protected function execute(InputInterface $input, OutputInterface $output)
  {
  	$inputFile = $input->getArgument('inputFile');		
		if (! file_exists($inputFile))
			throw new \Exception("File not exists: {$inputFile}", 1);

		$canary = new Canary;
		$canary->run($inputFile);

		if (false === $canary->writeOut())
			throw new \Exception("Error trying to write to file", 2);

		$output->writeln(sprintf('- %s', $canary->getOutputFile()));
		$output->writeln('<info>File was generated successfully!</info>');
  }

	
}