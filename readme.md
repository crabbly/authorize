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

## Usage

### The Basics


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