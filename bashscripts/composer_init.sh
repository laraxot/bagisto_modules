#!/bin/sh
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"
php -r "unlink('composer.lock');"
rm composer.lock
rm package-lock.json

php -d memory_limit=-1 composer.phar require -W  spatie/laravel-cookie-consent
php -d memory_limit=-1 composer.phar require -W  guzzlehttp/guzzle
php -d memory_limit=-1 composer.phar require -W  intervention/image
php -d memory_limit=-1 composer.phar require -W  intervention/imagecache
