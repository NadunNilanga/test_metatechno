database name :db_metatechno_test

composer create-project laravel/laravel test_metatechno
cd test_metatechno
code .
composer require laravel/ui
php artisan ui bootstrap
php artisan ui bootstrap --auth
npm install
npm run dev

npm install bootstrap@next --save-dev
npm install @popperjs/core --save-dev

npx mix
php artisan serve
php artisan make:seeder UserSeeder
php artisan db:seed
php artisan make:model ExternalUser -mcr
php artisan make:Factory ExternalUser
php artisan make:seeder ExternalUserSeeder
