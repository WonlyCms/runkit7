--TEST--
runkit_import() Importing and overriding functions
--SKIPIF--
<?php if(!extension_loaded("runkit7") || !RUNKIT_FEATURE_MANIPULATION || !function_exists('runkit_import')) print "skip"; ?>
--FILE--
<?php

function foo()
{
	return "foo()\n";
}

print(foo());
runkit_import(dirname(__FILE__) . '/runkit_import_functions.inc', RUNKIT_IMPORT_FUNCTIONS);
print(foo());
runkit_import(dirname(__FILE__) . '/runkit_import_functions.inc', RUNKIT_IMPORT_OVERRIDE | RUNKIT_IMPORT_FUNCTIONS);
print(foo());
?>
--EXPECT--
foo()
foo()
IMPORTED: foo()
