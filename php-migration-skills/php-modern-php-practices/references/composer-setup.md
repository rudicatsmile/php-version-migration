# Composer & PSR-4 Setup for Legacy Projects

## Minimal composer.json Template

```json
{
    "name": "your-org/your-app",
    "description": "Legacy application modernized to PHP 8.4",
    "type": "project",
    "require": {
        "php": "^8.3"
    },
    "require-dev": {
        "phpunit/phpunit": "^11.0",
        "phpstan/phpstan": "^2.0",
        "rector/rector": "^2.0",
        "phpcompatibility/php-compatibility": "*"
    },
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        },
        "files": [
            // only for truly global helper functions if needed
        ]
    },
    "autoload-dev": {
        "psr-4": {
            "Tests\\": "tests/"
        }
    },
    "scripts": {
        "test": "phpunit",
        "stan": "phpstan analyse",
        "rector": "rector process --dry-run"
    },
    "config": {
        "optimize-autoloader": true,
        "sort-packages": true
    }
}
```

## Migration Steps

1. Create the file above in the project root.
2. Create the `src/` directory.
3. Move existing class files into `src/` and add proper namespaces.
4. Update all `require` / `include` of those classes → remove them.
5. Run:
   ```bash
   composer install
   composer dump-autoload -o
   ```
6. Update the main entry points (index.php, etc.) to require `vendor/autoload.php`.

## Example Namespace Migration

**Before (legacy):**
```php
// includes/User.php
class User {
    // ...
}
```

**After:**
```php
// src/User.php
<?php

declare(strict_types=1);

namespace App;

class User
{
    // ...
}
```

Then in other files:
```php
use App\User;
```

## Tips

- Start with one module (e.g. models or services) to reduce risk.
- Keep procedural helper functions in a `files` autoload entry only if they are truly global and hard to convert.
- After autoloading works, you can gradually stop using `require_once` everywhere.
