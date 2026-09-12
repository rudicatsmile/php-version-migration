---
name: php-rector-modernizer
description: Use when applying automated refactoring to legacy PHP code with Rector. Triggers on Rector, automated upgrades, mechanical code transformations, PHP version level sets, dry-run refactoring, or modernizing syntax after a compatibility scan.
---

# PHP Rector Modernizer

Use Rector to perform safe, automated, mechanical upgrades on legacy PHP codebases during migration from PHP 5.6/7.x to PHP 8.3/8.4.

## Core Rules

- Always run with `--dry-run` first and review the full diff.
- Apply changes in small, reviewable batches.
- Prefer progressive level sets (UP_TO_PHP_74 → UP_TO_PHP_80 → … → UP_TO_PHP_84) instead of jumping straight to the final version.
- Commit after every successful batch.
- Never enable aggressive rule sets on a large untested legacy codebase in one go.

## Recommended Workflow

1. **Install Rector**
   ```bash
   composer require --dev rector/rector
   ```

2. **Create a conservative rector.php**
   - Start with the lowest target version that still brings value.
   - See `references/rector-configs.md` for ready-to-use configurations.

3. **Dry-run and review**
   ```bash
   vendor/bin/rector process --dry-run
   ```
   - Save the output if needed for review.
   - Look for unexpected or dangerous changes (especially around database code, authentication, and complex conditionals).

4. **Apply the batch**
   ```bash
   vendor/bin/rector process
   ```

5. **Verify**
   - Run the application / smoke tests.
   - Re-run PHPCompatibility and PHPStan.
   - Commit with a clear message (e.g. "Rector: upgrade to PHP 7.4 rules").

6. **Raise the level and repeat**
   - Move to the next LevelSetList only after the previous batch is stable.

## Safe Progressive Strategy

| Stage | Level Set                  | Focus                              | Risk |
|-------|----------------------------|------------------------------------|------|
| 1     | UP_TO_PHP_74              | Syntax, each(), curly braces, etc. | Low  |
| 2     | UP_TO_PHP_80              | Type improvements, match, etc.     | Medium |
| 3     | UP_TO_PHP_81              | Enums readiness, readonly, etc.    | Medium |
| 4     | UP_TO_PHP_82 / 83 / 84    | Latest language features           | Higher |

Additional safe sets that can be added carefully:
- `SetList::CODE_QUALITY`
- `SetList::DEAD_CODE`
- `SetList::EARLY_RETURN`
- Type declaration rules (apply later, after the code is more stable)

## What Rector Handles Well

- Curly brace → square bracket array/string access
- `each()` → `foreach`
- `create_function()` → closures
- Short array syntax and many coding standard improvements
- Adding scalar types and return types (when configured carefully)
- Switching some `switch` to `match` (review strictly because of comparison differences)
- Constructor property promotion (PHP 8.0+)

## What Rector Does NOT Handle Fully (Needs Manual Work)

- `mysql_*` → PDO/mysqli (only partial help, security-critical)
- Complex business logic refactoring
- Introducing namespaces and PSR-4 structure
- Security hardening
- Full architectural modernization

For those, combine with the other skills (`php-legacy-to-modern-migration` and `php-compatibility-scanner`).

## Output Expectations

When helping the user:

- Always propose a dry-run first.
- Show the exact command to run.
- After a dry-run result is provided, help review risky changes.
- Suggest the next progressive step rather than enabling everything at once.
- Remind the user to test and commit after each batch.

## Related Resources

- Ready configurations → `references/rector-configs.md`
- Common pitfalls when using Rector on legacy code → `references/pitfalls.md`
