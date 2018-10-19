<?php

echo $_GET['timestamp'].'<br>';

$pieces = explode("-", $_GET['timestamp']);
echo $pieces[0].'<br>';
echo $pieces[1].'<br>';


?>