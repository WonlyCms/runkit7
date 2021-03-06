--TEST--
runkit_default_property_remove() remove private properties with inheritance
--SKIPIF--
<?php if(!extension_loaded("runkit7") || !RUNKIT_FEATURE_MANIPULATION) print "skip";
      if(!function_exists('runkit_default_property_remove')) print "skip";
?>
--INI--
error_reporting=E_ALL
display_errors=On
--FILE--
<?php
class RunkitClass {
    private $privateProperty = "original";
    function getPrivate() {return $this->privateProperty;}
}

class RunkitSubClass extends RunkitClass {
}

class RunkitSubSubClass extends RunkitSubClass {
    private $privateProperty = "overridden";
    function getPrivate1() {return $this->privateProperty;}
}

class RunkitSubSubSubClass extends RunkitSubSubClass {
}

ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

$obj = new RunkitClass();
$objs = new RunkitSubClass();
$objss = new RunkitSubSubClass();
$objsss = new RunkitSubSubSubClass();

runkit_default_property_remove('RunkitClass', 'privateProperty');
print_r(new RunkitClass());
print_r(new RunkitSubClass());
print_r(new RunkitSubSubClass());
print_r(new RunkitSubSubSubClass());
print_r($obj);
print_r($objs);
print_r($objss);
print_r($objsss);
echo $obj->getPrivate(), "\n";
echo $objs->getPrivate(), "\n";
echo $objss->getPrivate1(), "\n";
echo $objsss->getPrivate1(), "\n";
?>
--EXPECTF--
Notice: runkit_default_property_remove(): Making RunkitSubSubSubClass::privateProperty public to remove it from class without objects overriding in %s on line %d

Notice: runkit_default_property_remove(): Making RunkitSubSubClass::privateProperty public to remove it from class without objects overriding in %s on line %d

Notice: runkit_default_property_remove(): Making RunkitSubClass::privateProperty public to remove it from class without objects overriding in %s on line %d

Notice: runkit_default_property_remove(): Making RunkitClass::privateProperty public to remove it from class without objects overriding in %s on line %d
RunkitClass Object
(
)
RunkitSubClass Object
(
)
RunkitSubSubClass Object
(
    [privateProperty%sprivate] => overridden
)
RunkitSubSubSubClass Object
(
    [privateProperty%sprivate] => overridden
)
RunkitClass Object
(
    [privateProperty] => original
)
RunkitSubClass Object
(
    [privateProperty] => original
)
RunkitSubSubClass Object
(
    [privateProperty%sprivate] => overridden
    [privateProperty] => original
)
RunkitSubSubSubClass Object
(
    [privateProperty%sprivate] => overridden
    [privateProperty] => original
)
original
original
overridden
overridden

