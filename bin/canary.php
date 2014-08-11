#!/usr/bin/env php
<?php

foreach (array(__DIR__ . '/../../../autoload.php', __DIR__ . '/../vendor/autoload.php', __DIR__ . '/vendor/autoload.php') as $file) {
	if (file_exists($file)) {
	  define('CANARY_COMPOSER_INSTALL', $file);
	  break;
	}
}

require CANARY_COMPOSER_INSTALL;

use Symfony\Component\Console\Application;
use SaguiTech\Console\Command\WriteOutCommand;

$application = new Application();
$application->add(new WriteOutCommand);
$application->run();