Canary
======

Canary is a cleaner version of the PHP language, for a faster development.

Warning: The current version is highly unstable, and is under development by SaguiTech's team. Don't use it for production.

[![Build Status](https://travis-ci.org/SaguiTech/Canary.svg)](https://travis-ci.org/SaguiTech/Canary)

Features
--------

- Code without annoying semicolons;
- and the $ preceding variables.

Installation
------------
You can be cloning this repository and build a [PHP Archive (PHAR)](http://php.net/phar) using the [box-project](http://box-project.org/)
```shell
$ git clone https://github.com/SaguiTech/Canary.git
$ composer update
$ php vendor/bin/box build
$ chmod +x canary.phar
$ mv canary.phar /usr/local/bin/canary
```

Check the installation:
```shell
$ canary --version
```

Example
-------

file.cap

```
echo "hello!\n"

variableWithNumbers10 = 10

VariableA = 'yes'
varB = 'no'

if (VariableA == varB)
	echo 'yes!'
else
	echo 'no!'
```

Then run:

`$ canary run file.cap`

The output is (file.php):

```
<?php
echo "hello!\n";

$variableWithNumbers10 = 10;

$VariableA = 'yes';
$varB = 'no';

if ($VariableA == $varB)
	echo 'yes!';
else
	echo 'no!';

```

Other commands
--------------
```shell
$ canary run -h
```

Running the tests
-----------------
```shell
$ php vendor/bin/phpunit --bootstrap vendor/autoload.php tests/
```

Warning
-------

This code is not tested with many cases. It's under development.

Next steps
----------

- Implement unit tests;
- Lexical analysis.
