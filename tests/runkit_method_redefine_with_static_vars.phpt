--TEST--
redefining methods with static variables
--SKIPIF--
<?php if(!extension_loaded("runkit7") || !RUNKIT_FEATURE_MANIPULATION) print "skip"; ?>
--INI--
display_errors=on
--FILE--
<?php
ini_set('error_reporting', E_ALL & (~E_DEPRECATED) & (~E_STRICT));


class A {
    function m() {
        static $a = 0;
        $a++;
        return $a;
    }
}

echo A::m(), "\n";

runkit_method_copy('A', 'm1', 'A', 'm');
runkit_method_remove('A', 'm');

echo A::m1();
?>
--EXPECT--
1
2
