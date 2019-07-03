
<?php
/*connect to database*/

$db_host = 'mysql:host=mysql.dur.ac.uk';
$db_name = 'dbname=Xfcwj45_my_publications';
$db_user = 'fcwj45';
$db_pass = 'bo22ston';

$pdo = new PDO($db_host.';'.$db_name, $db_user, $db_pass);

?>
