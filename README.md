# PHP - Debugger
## Debugger created by
- Email: danielpihlstrom@gmail.com
- Linkedin: [@Daniel Pihlström](https://www.linkedin.com/in/daniel-pihlstr%C3%B6m-55983641/)
## Readme created by
- Email: denniskjellin@hotmail.com
- Linkedin: [@Dennis Kjellin](https://www.linkedin.com/in/denniskjellin/)

## Installation
Place the `class-util.php` file, for example, inside the `theme folder`, `includes`, or any location of your choice.

## Include the file
Include `class-util.php` by requiring it in your code, such as in `functions.php`:

```php
require_once plugin_dir_path(__FILE__) . 'includes/class-util.php';
```

## Edit `wp-config.php`

Add the following lines to the `wp-config.php` file:
```php
define( 'WP_DEBUG_DISPLAY', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG', false ); // Change to true/false depending on dev mode or production.
```

Refer to the `wp-config.php` file in this repository to see an example.

## Start Debugging
Open a `terminal` in the project and write the following command in the terminal:
```php
tail -f debug.log
```

## Debugging Specific Properties
To bebug or logger example:
```php
Util::debug('Vr_Modal class loaded');
Util::logger('Print out movies', $movie_list);
```

## Stop debuging
On Windows, press `Ctrl + C` to terminate the terminal, and on macOS, press `Cmd + C`.


## Happy Debuging!

