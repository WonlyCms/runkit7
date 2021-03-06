--TEST--
Runkit_Sandbox_Parent Class -- Echo
--SKIPIF--
<?php if(!extension_loaded("runkit7") || !RUNKIT_FEATURE_SANDBOX) print "skip"; 
      /* May not be available due to lack of TSRM interpreter support */
      if(!function_exists("runkit_sandbox_output_handler")) print "skip"; ?>
--FILE--
<?php
$php = new Runkit_Sandbox();
$php['output_handler'] = 'test_handler';
$php['parent_access'] = true;
$php['parent_echo'] = true;
$php->ini_set('display_errors', true);
$php->ini_set('html_errors', false);
$php->eval('$PARENT = new Runkit_Sandbox_Parent;
			echo "Foo\n";
			$PARENT->echo("BarBar\n");');

function test_handler($str) {
  if (strlen($str) == 0) return NULL; /* flush() */
  /* Echoing and returning have the same effect here, both go to parent's output chain */
  echo 'Received string from sandbox: ' . strlen($str) . " bytes long.\n";

  return strtoupper($str);
}
--EXPECT--
Received string from sandbox: 4 bytes long.
FOO
BarBar
