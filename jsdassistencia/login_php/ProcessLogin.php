<?php

require_once 'lib/passwordLib.php';

$user = $_REQUEST['username'];
$pwd  = $_REQUEST['pwd'];

$hash = '$2y$10$k2oZTZLf5DwrogTDEBhnEu.nYjW7.eo4CHdC6bhN7U9ukvg1L3mga';

if (!(strcmp ($user, "nw51") == 0 && password_verify ($pwd, $hash))) {
	echo 0;
} else {
	echo $hash;
}

?>