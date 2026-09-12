# Critical Breaking Changes: PHP 5.6 → 8.4

Prioritized list of changes that most frequently break real-world legacy applications. Focus on high-impact items first.

## 1. Database Access (Highest Priority - Security)

| Old (removed)          | Replacement                          | Notes |
|------------------------|--------------------------------------|-------|
| `mysql_connect()` etc. | PDO or `mysqli`                      | Always use prepared statements |
| `mysql_query()`        | `$pdo->query()` / `$pdo->prepare()`  | Never concatenate SQL |
| `mysql_fetch_*()`      | `$stmt->fetch(PDO::FETCH_ASSOC)`     | |

**Example migration:**
```php
// Old
$link = mysql_connect($host, $user, $pass);
mysql_select_db($db, $link);
$result = mysql_query("SELECT * FROM users WHERE id = $id");

// New (PDO)
$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();
```

## 2. Completely Removed Functions

- `each()` → `foreach`
- `create_function()` → anonymous functions / closures
- `ereg()`, `eregi()`, `ereg_replace()`, `eregi_replace()`, `split()` → `preg_*`
- `mcrypt_*` → OpenSSL or Sodium
- `mysql_*` (entire extension)
- `__autoload()` → `spl_autoload_register()` or Composer
- `get_magic_quotes_gpc()`, `set_magic_quotes_runtime()`

## 3. Syntax Changes

| Old Syntax                     | New Syntax                  | Since |
|--------------------------------|-----------------------------|-------|
| `$arr{0}` / `$str{0}`          | `$arr[0]` / `$str[0]`       | 7.4+ (removed later) |
| `list() = each($arr)`          | `foreach`                   | 7.2+ |
| Call-time pass-by-ref `foo(&$a)` | Forbidden                   | 5.4 already, fatal later |
| `array()`                      | Prefer `[]`                 | Style |

## 4. Type System & Error Handling (PHP 7 → 8)

- Calling non-static method statically → Error
- String vs number comparison: `"foo" == 0` is now `false`
- Optional parameter before required parameter → Error in 8.0+
- Many notices became Warnings or Errors
- `assert()` throws by default
- Constructors named the same as the class no longer work as constructors (use `__construct`)

## 5. PHP 8.0+ Specific

- `$GLOBALS` can no longer be written as a whole
- Nested ternary without parentheses deprecated then removed
- `(real)` and `(unset)` casts removed
- `match` and `mixed` became reserved words
- Resource types migrated to objects (curl, gd, xml, etc.) — check with `is_object()` or type checks carefully

## 6. PHP 8.1 – 8.4 Notable Items

- Null to non-nullable internal function parameters → Deprecation then Error
- Implicitly nullable types (`function foo(string $a = null)`) deprecated in 8.4 → use `?string`
- `E_STRICT` constant deprecated/removed
- `exit` / `die` behave more like functions (type coercion changes)
- Property hooks and asymmetric visibility are **new features**, not breaking changes — introduce only after stability

## Recommended Order of Fixes

1. Database layer (security)
2. Removed functions (`each`, `create_function`, `ereg*`, `mysql_*`)
3. Curly braces and simple syntax
4. Static analysis findings (undefined variables, wrong types)
5. Type declarations and `strict_types`
6. Namespaces + Composer
7. New PHP 8.4 features (optional)
