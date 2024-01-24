# PHP - Debuger

## Where to put the file:
Place the class-util.php for example inside theme-folder, includes or the place of your own choice.

## Include the file:
Include the class-util.php by requiring it in your code, for example in functions.php.

require_once plugin_dir_path(__FILE__) . 'includes/class-util.php';

## Edit the wp-config.php

Add the following lines to the wp-config.php file:
define( 'WP_DEBUG_DISPLAY', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG', false ); -> change to true/false depending on dev mode or production.

See the wp-config.php file in this repository for a example.

## Start debuging:
Open a terminal in the project and write the following command in the terminal:
tail -f debug.log

## To debug specific properties example:
Util::debug('Vr_Modal class loaded');
Util::logger('Print out movies', $movie_list);

## Stop debuging:
On Windows predd ctrl + C to kill the terminal and on MaC Cmnd + C.

## Happy Debuging!

