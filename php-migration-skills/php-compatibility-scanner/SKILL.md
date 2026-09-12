---
name: php-compatibility-scanner
description: Use when scanning legacy PHP code for compatibility issues with PHP 7.x or 8.x versions. Triggers on PHPCompatibility, phpcs compatibility checks, detecting removed functions, deprecations, reserved keywords, or preparing a codebase for upgrade from PHP 5.6/7.x to 8.3/8.4.
---

# PHP Compatibility Scanner

Scan and analyze legacy PHP codebases for incompatibilities before and during migration to modern PHP versions (especially 8.3 / 8.4).

## When to Use This Skill

- Before starting any migration
- After each intermediate upgrade step
- When the user provides code snippets or file paths and asks "will this work on PHP 8.4?"
- When looking for removed functions, deprecations, or reserved words

## Core Workflow

1. **Determine target version**
   - Prefer scanning against intermediate versions first (7.4, then 8.0, then 8.1, etc.).
   - Final target is usually PHP 8.4.

2. **Run PHPCompatibility (primary tool)**
   - Install if needed: `composer require --dev phpcompatibility/php-compatibility`
   - Command pattern:
     ```bash
     phpcs /path/to/code \
       --standard=PHPCompatibility \
       --runtime-set testVersion 8.4 \
       --report=full \
       -p
     ```
   - Useful flags:
     - `--runtime-set testVersion 7.4-8.4` (range)
     - `--report=summary` or `--report=json` for large codebases
     - `-s` to show sniff codes

3. **Interpret results by severity**
   - **Error / Removed** → must fix before running on target version
   - **Warning / Deprecated** → fix soon (will become error later)
   - **Info** → style or future-proofing

4. **Cross-check with static analysis**
   - Run PHPStan or Psalm after the compatibility scan.
   - Many type-related issues only surface under stricter analysis.

5. **Produce actionable report**
   - Group findings by category (database, removed functions, syntax, types, etc.).
   - Provide concrete before/after examples for the most common issues.
   - Prioritize security-related findings first.

## Priority Categories to Report

1. **Security-critical** (mysql_*, unescaped queries, dangerous functions)
2. **Removed functions** (each, create_function, ereg*, split, mcrypt_*, etc.)
3. **Fatal syntax / language changes** (curly braces, call-time pass-by-ref, reserved keywords)
4. **Type & error handling changes** (non-static calls, string/number comparison, optional before required params)
5. **PHP 8.4 specific** (implicitly nullable types, E_STRICT, exit/die behavior)

Detailed lists and replacement patterns are in `references/common-issues.md`.

## Recommended Reporting Format

When giving results to the user, structure the answer like this:

```
## Compatibility Scan Summary (Target: PHP 8.4)

**Critical (must fix):**
- ...

**High (should fix soon):**
- ...

**Medium / Deprecations:**
- ...

**Suggested next actions:**
1. ...
2. ...
```

Always include file + line references when available, and show short before/after code for the top issues.

## Integration with Other Skills

- Use together with `php-legacy-to-modern-migration` for the overall plan.
- After scanning, hand off mechanical fixes to Rector (see related skill).
- After fixes, re-scan to confirm progress.

## Quick Commands

```bash
# Basic scan for PHP 8.4
phpcs . --standard=PHPCompatibility --runtime-set testVersion 8.4 -p

# Scan only certain directories
phpcs src/ app/ --standard=PHPCompatibility --runtime-set testVersion 8.4

# Generate a summary report
phpcs . --standard=PHPCompatibility --runtime-set testVersion 8.4 --report=summary

# JSON output for further processing
phpcs . --standard=PHPCompatibility --runtime-set testVersion 8.4 --report=json > compatibility-report.json
```

## Important Notes

- PHPCompatibility is the most accurate tool for version-specific language changes.
- It does **not** catch every runtime issue (especially dynamic code). Always combine with actual testing under the target PHP version.
- For very large codebases, run the scanner in stages (by directory or by severity).
