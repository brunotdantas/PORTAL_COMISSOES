<?php ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <link rel="stylesheet" href="dist/daterangepicker.min.css">
    <script type="text/javascript" src="moment.min.js"></script>
    <script type="text/javascript" src="jquery.min.js"></script>
    <script type="text/javascript" src="dist/jquery.daterangepicker.min.js"></script>

</head>

<body>
<input type="text" name="daterange" value="01/01/2018 - 01/15/2018"/>

</body>
<script>

$(function() {
$('input[name="daterange"]').daterangepicker({
opens: 'left'
}, function(start, end, label) {
console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
});
});
</script>




</html>