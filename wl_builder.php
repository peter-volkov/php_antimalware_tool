<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////
// Whitelist Builder
//
// Greg Zemskov, ai@revisium.com
///////////////////////////////////////////////////////////////////////////////////////////////////////

require_once('classes/WhileListBuilder.inc.php');

if (php_sapi_name() != 'cli') {
   echo $argv[0] . " could be launched in php-cli mode, from command line.";
   die(-1);
}


if ($argc < 2) { 
   echo "Usage: " . $argv[0] ." <start folder> <filename>\n";
   echo "\n";
   echo "e.g. wl_builder.php src wl_wordpress_3_6_1.xml\n";

   die(-2);
}


$wb_object = new WhiteListBuilder($argv[1], $argv[2]);
$wb_object->generate();

?>

