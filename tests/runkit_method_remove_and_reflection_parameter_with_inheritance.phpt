--TEST--
runkit_method_remove() function with ReflectionParameter and inheritance
--SKIPIF--
<?php if(!extension_loaded("runkit7") || !RUNKIT_FEATURE_MANIPULATION) print "skip"; ?>
--FILE--
<?php
class RunkitClass {
	function runkitMethod(RunkitClass $param) {
		echo "Runkit Method\n";
	}
}
class RunkitSubClass extends RunkitClass {}

$obj = new RunkitSubClass();

$reflMethod = new ReflectionMethod('RunkitSubClass', 'runkitMethod');
$reflParam = $reflMethod->getParameters();
$reflParam = $reflParam[0];

runkit_method_remove('RunkitClass','runkitMethod');

var_dump($reflParam);
try {
	var_dump($reflParam->getDeclaringFunction());
} catch (Error $e) {
	echo "\n";
	printf("(No longer a )Fatal error: %s in %s on line %d", $e->getMessage(), $e->getFile(), $e->getLine());
}
?>
--EXPECTREGEX--
object\(ReflectionParameter\)#\d+ \(1\) {
  \["name"\]=>
  string\(31\) "__parameter_removed_by_runkit__"
}

.*Fatal error:.*Internal error: Failed to retrieve the reflection object in .* on line \d+
