# Snap
Small ticket-based support system written in Laravel 3.

## Installation

1. Clone the git repository
2. `cd` into the repo, and run `composer install`
3. Create a MySQL database using the `db.sql` file, included in the repository
4. Change the application key in `application/config/application.php`
5. Change the database configuration in `application/config/database.php`
6. Run `php artisan migrate:install` and then `php artisan migrate` - this is not *necessary* but it's just for safety

You should be all set. Before starting, you may want to change the usernames, department names, company names, and etc. through the database. The 1st ticket may also be edited.

**Note:** be sure that, if you're not using a MySQL sock file, you delete the `unix_file` key from the database configuration. It can get messy.

## Like it?

Fork it! Make PR's! I don't mind. It's for everyone to use :)

I wanted to migrate it to L4 and localise, but days have only 24 hours :()