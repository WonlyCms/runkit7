--TEST--
runkit_import() method and reflection
--SKIPIF--
<?php if(!extension_loaded("runkit7") || !RUNKIT_FEATURE_MANIPULATION || !function_exists('runkit_import')) print "skip"; ?>
--FILE--
<?php
class RunkitClass {
	function runkitMethod(RunkitClass $param) {
		echo "Runkit Method\n";
	}
}

$obj = new RunkitClass();

$reflClass = new ReflectionClass('RunkitClass');
$reflObject = new ReflectionObject($obj);
$reflMethod = new ReflectionMethod('RunkitClass', 'runkitMethod');

runkit_import('runkit_import_method_and_reflection.inc', RUNKIT_IMPORT_CLASS_METHODS | RUNKIT_IMPORT_OVERRIDE);

var_dump($reflMethod);
$reflMethod->invoke($obj);
?>
--EXPECTF--
object(ReflectionMethod)#%d (2) {
  ["name"]=>
  string(28) "__method_removed_by_runkit__"
  ["class"]=>
  string(11) "RunkitClass"
}

Fatal error: RunkitClass::__method_removed_by_runkit__(): A method removed by runkit7 was somehow invoked in %s on line %d
