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

## Basics

### Tables

After the migration, four new tables will be present:
- `roles` &mdash; stores role records
- `role_user` &mdash; stores [many-to-many](https://laravel.com/docs/5.2/eloquent-relationships#many-to-many) relations between roles and users
- `permissions` &mdash; stores permission records
- `permission_role` &mdash; stores [many-to-many](https://laravel.com/docs/5.2/eloquent-relationships#many-to-many) relations between roles and permissions

### Models

The package comes with two models, `Role` and `Permission`.

###### Role

The `Role` model has three main attributes:
- `name` &mdash; Unique name for the Role, used for looking up role information in the application layer. For example: "admin", "owner", "employee".
- `display_name` &mdash; Human readable name for the Role. For example: "User Administrator", "Project Owner", "Company Employee".
- `description` &mdash; A more detailed explanation of what the Role does. This field is optional and nullable in the database.

###### Permission

The `Permission` model has the same three attributes as the `Role`:
- `name` &mdash; Unique name for the permission, used for looking up permission information in the application layer. For example: "create-post", "edit-user".
- `display_name` &mdash; Human readable name for the permission. Not necessarily unique. For example "Create Posts", "Edit Users".
- `description` &mdash; A more detailed explanation of the Permission.


## Usage

### Creating Roles

Create an `admin` role:

```php
<?php

  use Crabbly\Authorize\Role;

  ...

  Role::create([
            'name' => 'admin',
            'display_name' => "Administrator",
            'description' => '' //optional
        ]);
```

### Assigning and Removing Roles

Roles and Users have a Many to Many relationship. We can attach and detach roles to users like this:

```php
<?php

  //add role of id $role_id to $user
  $user->roles()->attach($role_id);

  //remove role of id $role_id to $user
  $user->roles()->detach($role_id);

```


### Checking if User has a Role

To check if a User is assigned with the Role `admin`:

```php
<?php

  if ($user->hasRole('admin')) // pass in role name
  {
    //admin only code
  }

```

Most apps will probably have an `admin` Role, for this we can just use:

```php
<?php

  if ($user->isAdmin())
  {
    //admin only code
  }

```

### Creating Permissions

Create an `delete_users` permission:

```php
<?php

  use Crabbly\Authorize\Permission;

  ...

  Permission::create([
            'name' => 'delete_users',
            'display_name' => "Delete Users",
            'description' => '' //optional
        ]);
```

### Assigning and Removing Permissions

Permissions and Roles have a Many to Many relationship. We can attach and detach permissions to roles like this:

```php
<?php

  //add permission of id $permission_id to $role
  $role->permissions()->attach($permission_id);

  //remove permission of id $permission_id to $role
  $user->permissions()->detach($permission_id);

```


### Checking if User has Permission

To check if a User has the Permission `delete_users`:

```php
<?php

  if ($user->hasPermission('delete_users')) // pass in permission name
  {
    //delete users code
  }

```

This will check if any of the Roles that were assigned to the user, has the Permission `delete_users`.

## Contribution

Pull requests are welcome.
Please report any issue you find in the issues page.

## License

Authorize is free software distributed under the terms of the MIT license.
