<?php


  // make sure the class is loaded.
  require_once('./path/to/template.class.php');

  // assign the template to a variable
  $tpl = new Template('./path/to/template.file.tpl');
  
  // change the variables
  $tpl->set("some_var","some_value");
  
  // output the altered template.
  // can be echo'd directly, or assigned to another variable
  // for appending other stuff to.
  echo $tpl->publish();

?>
