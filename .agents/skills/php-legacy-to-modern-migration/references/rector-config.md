# Recommended Rector Configuration for Legacy Migration

Use Rector for mechanical upgrades. Always start with dry-run.

## Installation

```bash
composer require --dev rector/rector
```

## Minimal Safe rector.php for PHP 5.6 → 7.4 first

```php
<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/src',
        __DIR__ . '/app',
        // add your paths
    ])
    ->withSkip([
        // temporarily skip problematic files if needed
    ])
    ->withSets([
        LevelSetList::UP_TO_PHP_74,
        SetList::CODE_QUALITY,
        SetList::DEAD_CODE,
    ])
    ->withImportNames()
    ->withParallel();
```

## Progressive Upgrade Strategy

1. First run: `LevelSetList::UP_TO_PHP_74`
2. Review + commit
3. Then `UP_TO_PHP_80`
4. Then `UP_TO_PHP_81`
5. Continue up to `UP_TO_PHP_84`

Do **not** enable all sets at once on a large legacy codebase.

## Useful Individual Rules for Legacy Code

- `CurlyBraceArrayAccessRector` (or equivalent in newer Rector)
- `EachToForeachRector`
- `CreateFunctionToAnonymousFunctionRector`
- `MysqlToMysqliRector` (limited — often needs manual review)
- Rules that add type declarations (apply later)

## Best Practices with Rector

- Always `vendor/bin/rector process --dry-run` first
- Review the full diff
- Run tests / smoke test after each apply
- Commit after every successful batch
- Combine with PHPCompatibility to know what still needs manual work
- After Rector, run PHPStan to catch remaining issues

## Example Safe Workflow

```bash
# 1. Dry run
vendor/bin/rector process --dry-run > rector-diff.txt

# 2. Review the file
less rector-diff.txt

# 3. Apply
vendor/bin/rector process

# 4. Static analysis
vendor/bin/phpstan analyse

# 5. Commit
git add -A && git commit -m "Rector: upgrade to PHP 7.4 rules"
```
