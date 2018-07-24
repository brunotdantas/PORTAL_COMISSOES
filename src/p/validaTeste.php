<?php

echo $_GET['daterange'].'<br>';

$pieces = explode("-", $_GET['daterange']);
echo $pieces[0].'<br>';
echo $pieces[1].'<br>';


?>