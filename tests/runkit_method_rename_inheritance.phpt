--TEST--
runkit_method_rename() function and inheritance
--SKIPIF--
<?php if(!extension_loaded("runkit7") || !RUNKIT_FEATURE_MANIPULATION) print "skip"; ?>
--INI--
display_errors=on
--FILE--
<?php
ini_set('error_reporting', E_ALL & (~E_DEPRECATED) & (~E_STRICT));

class runkit_class {
	function runkit_original($a) {
		echo "Runkit Original: a is $a\n";
	}
}

class runkit_subclass extends runkit_class {
}

runkit_subclass::runkit_original(1);
runkit_method_rename('runkit_class','runkit_original','runkit_duplicate');
if (method_exists('runkit_subclass','runkit_original')) {
	echo "Runkit Original still exists!\n";
}
runkit_subclass::runkit_duplicate(2);
runkit_method_rename('runkit_class','runkit_duplicate', 'runkitDuplicate');
if (method_exists('runkit_subclass','runkit_duplicate')) {
	echo "Runkit Duplicate still exists!\n";
}
runkit_subclass::runkitDuplicate(3);
runkit_method_rename('runkit_class','runkitDuplicate', 'runkit_original');
if (method_exists('runkit_subclass','runkitDuplicate')) {
	echo "RunkitDuplicate still exists!\n";
}
runkit_subclass::runkit_original(4);
runkit_subclass::runkitDuplicate(4);
?>
--EXPECTF--
Runkit Original: a is 1
Runkit Original: a is 2
Runkit Original: a is 3
Runkit Original: a is 4

Fatal error: Uncaught Error: Call to undefined method runkit_subclass::runkit%suplicate() in %s:%d
Stack trace:
#0 {main}
  thrown in %s on line %d
