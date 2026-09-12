# Common Compatibility Issues & Replacements

Quick reference of the most frequent problems found when scanning PHP 5.6 / early 7.x code for PHP 8.x compatibility.

## 1. Completely Removed Functions

| Function / Feature              | Status     | Replacement                          | Notes |
|--------------------------------|------------|--------------------------------------|-------|
| `mysql_*` (entire extension)   | Removed    | PDO or mysqli + prepared statements  | Security critical |
| `each()`                       | Removed    | `foreach`                            | Very common |
| `create_function()`            | Removed    | Anonymous function / closure         | |
| `ereg()`, `eregi()`, `split()` | Removed    | `preg_match()`, `preg_split()`       | |
| `mcrypt_*`                     | Removed    | OpenSSL or Sodium                    | |
| `__autoload()`                 | Removed    | `spl_autoload_register()` or Composer | |
| `get_magic_quotes_gpc()`       | Removed    | Remove the check                     | |

## 2. Syntax That No Longer Works

| Old Code                        | New Code                     | Notes |
|---------------------------------|------------------------------|-------|
| `$array{0}` / `$str{0}`         | `$array[0]` / `$str[0]`      | Curly brace access removed |
| `foo(&$var)` (call-time)        | Pass by reference in definition only | Fatal |
| `list($k, $v) = each($arr)`     | `foreach ($arr as $k => $v)` | |
| Constructor named after class   | `__construct()`              | Old style constructors removed |

## 3. Behavioral Changes (Often Silent Breaks)

- `"foo" == 0` is now `false` (PHP 8 string-to-number comparison)
- Calling non-static method statically → Error
- Optional parameter declared before required parameter → Error
- Writing to `$GLOBALS` as a whole is restricted
- Many resources became objects (check with `is_resource()` may fail)

## 4. PHP 8.4 Specific Deprecations

- Implicitly nullable types:
  ```php
  // Deprecated
  function foo(string $a = null) {}

  // Correct
  function foo(?string $a = null) {}
  // or
  function foo(string|null $a = null) {}
  ```
- `E_STRICT` constant deprecated
- `exit` / `die` now behave more like functions (type checking applies)

## 5. Recommended Fix Priority

1. Anything using `mysql_*` (security + removed)
2. `each()` and `create_function()`
3. Curly brace syntax
4. Deprecated / removed extensions (mcrypt, etc.)
5. Type-related deprecations (especially for 8.4)
6. Style and future-proofing issues

## 6. How to Verify a Fix

After changing code:

1. Re-run PHPCompatibility scan on the affected files.
2. Run the code under the target PHP version.
3. Check for new deprecation notices or fatal errors.
4. Run static analysis (PHPStan) to catch related type issues.
