--TEST--
removing magic unserialize method
--SKIPIF--
<?php if(!extension_loaded("runkit7") || !RUNKIT_FEATURE_MANIPULATION) print "skip";
?>
--FILE--
<?php
class Test implements Serializable {
	function serialize() {return "";}
	function unserialize($s) {}
}

$a = new Test();
runkit_method_remove("Test", "unserialize");
$s1 = serialize($a);
unserialize($s1);
?>
--EXPECTF--
Fatal error: Couldn't find implementation for method Test::unserialize in Unknown on line %d
