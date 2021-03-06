--TEST--
runkit_import() Importing and overriding constants with inheritance
--SKIPIF--
<?php
    if(!extension_loaded("runkit7") || !RUNKIT_FEATURE_MANIPULATION) print "skip";
    if(!function_exists('runkit_import')) print "skip"
?>
--FILE--
<?php
// Hacky workaround so that runkit won't inline constants within opcodes of this file.
if (!class_exists('Test')) {
class Test {
    const C = 1;
    const D = "aaa";
    const E = 3;
}
class Test1 extends Test {
}
}
runkit_import(dirname(__FILE__) . '/runkit_import_constants_and_inheritance.inc', RUNKIT_IMPORT_CLASS_METHODS | RUNKIT_IMPORT_CLASS_CONSTS | RUNKIT_IMPORT_OVERRIDE);
var_dump(Test::C);
var_dump(Test::D);
var_dump(Test::E);
var_dump(Test1::C);
var_dump(Test1::D);
var_dump(Test1::E);
runkit_constant_remove('Test1::E');
var_dump(Test::E);
runkit_constant_remove('Test::E');
?>
--EXPECT--
int(4)
string(4) "bbbb"
int(6)
int(4)
string(4) "bbbb"
int(6)
int(6)
