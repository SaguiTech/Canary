Canary
======

Canary is a cleaner version of the PHP language, for a faster development.

The current version is highly unstable, and is under development
by SaguiTech's team. Don't use it for production.

Features
--------

- Code without annoyng semicolons;
- and the $ preceding variables.

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

`$ php bin/canary.php run examples/file.cap`

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
php bin/canary.php run -h
```

Warning
-------

This code is not tested with many cases. It's under development.
