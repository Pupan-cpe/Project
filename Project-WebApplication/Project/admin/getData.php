<?php

// It reads a json formatted text file and outputs it.

$string = file_get_contents("data.json");
echo $string;

// Instead you can query your database and parse into JSON.

?>