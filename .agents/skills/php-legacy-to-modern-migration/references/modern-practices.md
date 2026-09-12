# Modern PHP Practices After Version Upgrade

Apply these only after the application runs stably on PHP 8.3/8.4.

## 1. Project Structure & Autoloading

- Add `composer.json` if missing
- Use PSR-4 autoloading
- Move classes into `src/` with proper namespaces
- Remove all `require` / `include` of class files

Example `composer.json` skeleton:

```json
{
    "name": "your-org/legacy-app",
    "require": {
        "php": "^8.3"
    },
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    },
    "require-dev": {
        "phpunit/phpunit": "^11.0",
        "phpstan/phpstan": "^2.0",
        "rector/rector": "^2.0"
    }
}
```

## 2. Type System

- Add `declare(strict_types=1);` to every new or heavily refactored file
- Add parameter, return, and property types
- Prefer union types and nullable types (`?string`, `string|int`)
- In PHP 8.4: consider property hooks instead of classic getters/setters for simple cases

## 3. Error & Exception Handling

- Convert `@` error suppression to proper checks
- Prefer exceptions over returning `false` or error codes for domain errors
- Use `Throwable` in catch blocks when appropriate

## 4. Security Baseline

- All database access via prepared statements
- Output escaping (or better: a templating engine)
- CSRF protection on state-changing forms
- Password hashing with `password_hash()` / `password_verify()`
- Disable dangerous functions if possible via `disable_functions`

## 5. Useful PHP 8.x Features to Adopt Gradually

| Feature                    | Version | When to use |
|---------------------------|---------|-------------|
| Nullsafe operator `?->`   | 8.0     | Deep property/method chains |
| Named arguments           | 8.0     | Clearer function calls |
| Match expression          | 8.0     | Replacing complex switch |
| Constructor promotion     | 8.0     | DTOs and simple classes |
| Enums                     | 8.1     | Status codes, types |
| Readonly properties       | 8.1     | Immutable data |
| Intersection types        | 8.1     | Advanced typing |
| Property hooks            | 8.4     | Computed / virtual properties |
| Asymmetric visibility     | 8.4     | Public read, private write |
| `array_find`, `array_any` | 8.4     | Cleaner array searches |

## 6. Testing

- Add PHPUnit smoke tests for critical paths before large refactors
- Aim for at least coverage of authentication, main business flows, and payment/checkout if present
- Run tests under both old and new PHP versions during transition

## 7. Deployment Notes

- Use the same PHP version in CI, staging, and production
- Monitor error logs closely for the first days after switch
- Keep a rollback plan (previous PHP version + previous code tag)
