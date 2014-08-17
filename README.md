Canary
======

Canary is a cleaner version of the PHP language, for a faster development.

The current version is highly unstable, and is under development
by SaguiTech's team. Don't use it for production.

Features
--------

- Code without annoyng semicolons;
- and the $ preceding variables.

Installation
------------
We distribute a [PHP Archive (PHAR)](http://php.net/phar) that has all required dependencies of Canary bundled in single file:
```shell
wget https://jonataa.github.io/phar/canary.phar
chmod +x canary.phar
mv canary.phar /usr/local/bin/canary
```

(or)

You can clone this repository and build using the [box-project](http://box-project.org/)
```shell
git clone <https://github.com/jonataa/Canary.git>
php vendor/bin/box build
chmod +x canary.phar
mv canary.phar /usr/local/bin/canary
```

Check the installation:
```shell
canary --version
```

Example
-------

file.cap

````
echo "hello!\n"

variableWithNumbers10 = 10

VariableA = 'yes'
varB = 'no'

if (VariableA == varB)
	echo 'yes!'
else
	echo 'no!'
````

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
canary run -h
```

Warning
-------

This code is not tested with many cases. It's under development.
