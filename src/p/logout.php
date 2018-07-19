<?php

session_start();

session_destroy();

try{
	echo '<script type="text/javascript">
               window.location = "../../index.php"
          </script>';
	//header("location: http://localhost/gestaosaudeumc/index.php");
} catch(Exception $e){}

exit();
?>
