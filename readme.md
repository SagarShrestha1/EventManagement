## Laravel Roles Permissions Admin - Spatie version

__Update Auguest 2023__: this project was created in 2023 as Laravel 9.19 version(updated), and now we upgraded it to Laravel 6 version, also changed the design theme from [AdminLTE](https://adminlte.io/) to [CoreUI](https://coreui.io)

- - - - -


![Roles Permissions screenshot](https://laraveldaily.com/wp-content/uploads/2019/10/laravel-roles-permissions-users.png)

![Roles Permissions screenshot 02](https://laraveldaily.com/wp-content/uploads/2019/10/laravel-roles-permissions-roles.png)

## Usage

This is not a package - it's a full Laravel project that you should use as a starter boilerplate, and then add your own custom functionality.

- Clone the repository with `git clone`
- Copy `.env.example` file to `.env` and edit database credentials there
- Run `composer install`
- Run `php artisan key:generate`
- Run `php artisan migrate --seed` (it has some seeded data - see below)
- That's it: launch the main URL and login with default credentials `admin@admin.com` - `password`

This boilerplate has one role (`administrator`), one permission (`users_manage`.'event_manage') and one administrator user.

With that user you can create more roles/permissions/users, and then use them in your code, by using functionality like `Gate` or `@can`, as in default Laravel, or with help of Spatie's package methods.

## License

The [MIT license](http://opensource.org/licenses/MIT).

