#Zeus Admin.
Laravel SPA Admin-panel interface.

#Installation

##Via composer
composer require "brainor-rus/zeus-admin":"^1.0"

#Post install

###1) Service provider
Service provider is applied automatically.

###2) To publish vendor files, views and assets use command:

php artisan vendor:publish --provider="Zeus\Admin\Providers\ZeusAdminServiceProvider"

###3) To apply CMS and Plugins Migrations use command:

php artisan migrate
