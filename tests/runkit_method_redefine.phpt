--TEST--
runkit_method_redefine() function
--SKIPIF--
<?php if(!extension_loaded("runkit7") || !RUNKIT_FEATURE_MANIPULATION) print "skip"; ?>
--INI--
display_errors=on
--FILE--
<?php
ini_set('error_reporting', E_ALL & (~E_DEPRECATED) & (~E_STRICT));

class runkit_class {
	function runkit_method($a) {
		echo "a is $a\n";
	}
	function runkitMethod($a) {
		echo "a is $a\n";
	}
}
runkit_class::runkit_method('foo');
runkit_method_redefine('runkit_class','runkit_method','$b', 'echo "b is $b\n";');
runkit_class::runkit_method('bar');
runkit_class::runkitMethod('foo');
runkit_method_redefine('runkit_class','runkitMethod','$b', 'echo "b is $b\n";');
runkit_class::runkitMethod('bar');
?>
--EXPECT--
a is foo
b is bar
a is foo
b is bar
