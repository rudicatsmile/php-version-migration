# Ready-to-Use Rector Configurations

## 1. Conservative Start (PHP 5.6/7.x → 7.4)

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
        __DIR__ . '/includes',
        // add your directories
    ])
    ->withSkip([
        // temporarily skip problematic files or directories if needed
        // __DIR__ . '/legacy/old-lib',
    ])
    ->withSets([
        LevelSetList::UP_TO_PHP_74,
        SetList::CODE_QUALITY,
        SetList::DEAD_CODE,
    ])
    ->withImportNames(removeUnusedImports: true)
    ->withParallel();
```

## 2. Next Step (to PHP 8.0)

```php
->withSets([
    LevelSetList::UP_TO_PHP_80,
    SetList::CODE_QUALITY,
    SetList::DEAD_CODE,
    SetList::EARLY_RETURN,
])
```

## 3. Later Stages (PHP 8.1 → 8.4)

Raise the level gradually:

```php
LevelSetList::UP_TO_PHP_81
LevelSetList::UP_TO_PHP_82
LevelSetList::UP_TO_PHP_83
LevelSetList::UP_TO_PHP_84
```

## Useful Optional Rules (Add Carefully)

After the code is more stable, you can enable:

```php
use Rector\TypeDeclaration\Rector\ClassMethod\AddVoidReturnTypeWhereNoReturnRector;
use Rector\TypeDeclaration\Rector\Property\TypedPropertyFromStrictConstructorRector;
// etc.

->withRules([
    // add specific rules one by one
])
```

Or use:

```php
->withPreparedSets(
    deadCode: true,
    codeQuality: true,
    typeDeclarations: true,   // be careful on legacy code
    privatization: false,
    naming: false,
)
```

## Tips for Large Legacy Projects

- Start with a small path (one module) to validate the config.
- Use `->withSkip()` aggressively at the beginning.
- Prefer `withParallel()` for speed on bigger codebases.
- After each successful run, commit before changing the config.
