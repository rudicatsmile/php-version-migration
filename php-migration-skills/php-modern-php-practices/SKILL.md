---
name: php-modern-php-practices
description: Use when modernizing PHP code after a successful version upgrade to 8.3 or 8.4. Triggers on introducing namespaces, Composer, PSR-4, strict types, type declarations, property hooks, asymmetric visibility, modern security practices, or cleaning up legacy procedural code into better structure.
---

# PHP Modern Practices

Apply modern PHP practices **after** the application runs stably on PHP 8.3 or 8.4. This skill focuses on structure, typing, security, and leveraging new language features — not on version compatibility itself.

## When to Use This Skill

- The code already runs without fatal errors on PHP 8.3/8.4
- Compatibility scan and Rector mechanical upgrades are mostly done
- User wants to introduce Composer, namespaces, type system, or modern features
- Cleaning up remaining procedural / legacy style code

## Recommended Order of Modernization

1. **Composer + Autoloading** (foundation)
2. **Namespaces + PSR-4**
3. **declare(strict_types=1) + basic type declarations**
4. **Security hardening** (especially database and output)
5. **Code structure improvements** (separate concerns, reduce global state)
6. **Adopt newer PHP 8.x features** (only where they clearly improve the code)

## 1. Introduce Composer & PSR-4

- Create `composer.json` if it does not exist
- Move classes into a `src/` (or similar) directory
- Define PSR-4 autoloading
- Remove manual `require` / `include` of class files
- Run `composer dump-autoload`

See `references/composer-setup.md` for a ready template.

## 2. Namespaces

- Add namespaces gradually, module by module
- Update all references (use statements or FQCN)
- Keep the public entry points (index.php, etc.) simple

## 3. Type System

- Add `declare(strict_types=1);` to new and heavily refactored files first
- Start with parameter and return types on new or isolated functions/methods
- Use nullable types (`?string`) and union types where appropriate
- Prefer property types and constructor property promotion for simple classes
- In PHP 8.4: consider property hooks and asymmetric visibility for cleaner APIs

## 4. Security Baseline (High Priority)

Even after version upgrade, legacy apps often still have:

- SQL injection risks → force prepared statements everywhere
- XSS → proper output escaping or a templating engine
- Weak password storage → `password_hash()` / `password_verify()`
- Missing CSRF protection on state-changing actions
- Dangerous file operations or includes

Address these systematically.

## 5. Structure & Clean Code

- Reduce global variables and `$GLOBALS` usage
- Extract business logic out of presentation files
- Introduce simple service classes or dependency injection where it reduces complexity
- Replace large procedural scripts with clearer entry points + classes

## 6. Useful PHP 8.x Features to Adopt

| Feature                      | Min Version | Good Use Case                          |
|-----------------------------|-------------|----------------------------------------|
| Nullsafe operator `?->`     | 8.0         | Deep chains that may be null           |
| Named arguments             | 8.0         | Clearer calls to functions with many params |
| Match expression            | 8.0         | Replacing complex switch (after review) |
| Constructor promotion       | 8.0         | DTOs and simple value objects          |
| Enums                       | 8.1         | Status, types, constants with behavior |
| Readonly properties         | 8.1         | Immutable data                         |
| Property hooks              | 8.4         | Virtual / computed properties          |
| Asymmetric visibility       | 8.4         | Public read, private write             |
| `array_find`, `array_any`   | 8.4         | Cleaner array searching                |

Only introduce a feature when it makes the specific code clearer or safer.

## Output Expectations

When helping the user:

- Suggest changes in small, reviewable steps
- Show before/after code for structural improvements
- Prioritize security issues
- Warn when a modern feature might be premature for the current codebase maturity
- Recommend re-running PHPStan after adding types

## Related Skills

- Use `php-legacy-to-modern-migration` for the overall plan
- Use `php-compatibility-scanner` and `php-rector-modernizer` before this skill
