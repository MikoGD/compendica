<?php
$db = mysqli_connect ('localhost', 'root', '');
if ($db === FALSE )
{
    die('Fail message');
}// END IF

if (mysqli_select_db($db, "compendica") === FALSE) 
{
    die("Fail message");
}// END IF
?>
