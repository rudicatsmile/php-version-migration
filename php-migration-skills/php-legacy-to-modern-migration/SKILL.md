---
name: php-legacy-to-modern-migration
description: Use when migrating legacy PHP applications from PHP 5.6/7.x to modern PHP 8.3 or 8.4. Triggers on requests involving PHP upgrade, compatibility analysis, Rector, PHPCompatibility, deprecations, mysql_* removal, namespaces, Composer adoption, or modernizing procedural PHP code.
---

# PHP Legacy to Modern Migration

Migrate native PHP 5.6 (or early 7.x) applications safely to PHP 8.4 using an incremental, tool-assisted approach.

## Core Principles

- Never jump directly from 5.6 to 8.4 in one step. Upgrade incrementally (5.6 → 7.4 → 8.0 → 8.1 → 8.2 → 8.3 → 8.4).
- Prefer automated tools (PHPCompatibility + Rector) over manual rewrites for mechanical changes.
- Always run dry-run / analysis first. Review every diff.
- Keep the application running in production during migration (Strangler Fig pattern when possible).
- Add tests (even minimal smoke tests) before major changes.
- Prioritize security-critical issues (SQL injection via mysql_*, XSS, file inclusion) early.

## Recommended Migration Workflow

1. **Assess current state**
   - Run `php -v` and `php -m`.
   - Inventory all dependencies (manual includes, PEAR, old libraries).
   - Identify entry points, database layer, and authentication code.
   - Create a full backup + git tag of the current working state.

2. **Set up parallel environment**
   - Prefer Docker with multiple PHP versions side-by-side.
   - Install PHPCompatibility, Rector, PHPStan (or Psalm), and Composer.

3. **Scan for compatibility issues**
   - Use PHPCompatibility targeting the next intermediate version first.
   - Command example: `phpcs . --standard=PHPCompatibility --runtime-set testVersion 7.4 --report=full`
   - Later raise the target version step by step.

4. **Apply mechanical fixes with Rector**
   - Start with low-risk rule sets.
   - Always run with `--dry-run` first and review the diff.
   - Commit after each safe batch.

5. **Manual fixes for removed features**
   - Replace `mysql_*` with PDO or mysqli + prepared statements.
   - Replace `each()`, `create_function()`, `ereg*`, curly-brace array/string access, etc.
   - See references/breaking-changes.md for the prioritized list.

6. **Introduce modern structure**
   - Add `composer.json` and PSR-4 autoloading if missing.
   - Introduce namespaces gradually.
   - Add `declare(strict_types=1);` to new or heavily refactored files.
   - Add type declarations where safe.

7. **Static analysis and testing**
   - Run PHPStan (start at level 0–3 for legacy, raise later).
   - Execute the application and existing tests under the new PHP version.
   - Fix deprecation warnings before they become errors.

8. **Final jump to PHP 8.4**
   - Address PHP 8.4 specific deprecations (implicitly nullable types, etc.).
   - Take advantage of new features only after the code is stable (property hooks, asymmetric visibility, new array functions).

## Critical Breaking Changes to Watch (5.6 → 8.4)

High-impact items that commonly break legacy applications:

- `mysql_*` family completely removed → use PDO or mysqli.
- `each()`, `create_function()`, `ereg*`, `split()`, `mcrypt_*` removed.
- Curly brace array/string access (`$arr{0}`) removed → use `[]`.
- Call-time pass-by-reference removed.
- Non-static methods called statically → fatal error.
- String-to-number comparisons changed in PHP 8.
- Optional parameters before required parameters now error.
- `$GLOBALS` write restrictions.
- Many resources became objects (curl, gd, etc.).
- Implicitly nullable parameter types deprecated in PHP 8.4.

Full prioritized list and replacements live in `references/breaking-changes.md`.

## Tool Commands (Quick Reference)

```bash
# PHPCompatibility scan
phpcs /path/to/code --standard=PHPCompatibility --runtime-set testVersion 8.4 -p

# Rector dry-run (after configuring rector.php)
vendor/bin/rector process --dry-run

# Rector apply
vendor/bin/rector process

# PHPStan
vendor/bin/phpstan analyse -l 5 src
```

## When to Load Additional Resources

- For detailed breaking changes and replacement patterns → read `references/breaking-changes.md`
- For recommended Rector configuration → read `references/rector-config.md`
- For modern PHP practices after the version upgrade → read `references/modern-practices.md`

## Output Expectations

When helping a user:

- Always start with an assessment of the current codebase if files are provided.
- Propose an incremental plan with clear intermediate targets.
- Prefer concrete before/after code snippets for every suggested change.
- Flag security issues (especially database access) with high priority.
- Never claim a one-click full migration is safe for a real application.
