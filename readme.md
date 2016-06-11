# Authorize

Authorize is a package for Laravel that provides User Access Control using Roles and Permissions.


## Installation

### Step 1: Composer

From the command line, run:

```
composer require crabbly/authorize
```

### Step 2: Service Provider

For your Laravel app, open `config/app.php` and, within the `providers` array, append:

```
Crabbly\Authorize\AuthorizeServiceProvider::class
```

This will bootstrap the package into Laravel.


## Step 3: Publish and Run Migrations

php artisan vendor:publish --provider="Crabbly\Authorize\AuthorizeServiceProvider" --tag="migrations"

php artisan migrate

## Step 4: Add the `UserAuthorizeTrait` to your `User` model:

```php
<?php

namespace App;

use Crabbly\Authoriz\UserAuthorizeTrait;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use UserAuthorizeTrait;

    //...
}
```

## Usage

### Creating Roles

Create an `admin` role:

```php
<?php

  Role::create([
            'name' => 'admin',
            'display_name' => "Administrator",
            'description' => '' //optional
        ]);
```

### Adding and Removing Roles

Roles and Users have a Many to Many relationship. We can attach and detach roles to users like this:

```php
<?php

  //add role of id $role_id to $user
  $user->roles()->attach($role_id);

  //remove role of id $role_id to $user
  $user->roles()->detach($role_id);

```
