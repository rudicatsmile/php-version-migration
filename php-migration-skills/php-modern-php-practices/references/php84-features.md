# Useful PHP 8.4 Features (and earlier) for Modernization

Adopt these only when the code is already stable on PHP 8.3/8.4.

## Property Hooks (PHP 8.4)

Replace classic getter/setter boilerplate with hooks.

```php
class User
{
    public string $name {
        get => $this->name;
        set (string $value) {
            $this->name = trim($value);
        }
    }
}
```

Or virtual properties:

```php
class User
{
    private string $firstName;
    private string $lastName;

    public string $fullName {
        get => $this->firstName . ' ' . $this->lastName;
    }
}
```

## Asymmetric Visibility (PHP 8.4)

```php
class User
{
    public private(set) int $id;

    public function __construct(int $id)
    {
        $this->id = $id; // allowed
    }
}

// Outside: $user->id is readable, but not writable
```

## Array Helpers (PHP 8.4)

```php
$firstAdmin = array_find($users, fn(User $u) => $u->isAdmin());
$hasAdmin   = array_any($users, fn(User $u) => $u->isAdmin());
$allActive  = array_all($users, fn(User $u) => $u->isActive());
```

## Earlier Features Still Very Useful

### Nullsafe Operator (8.0)
```php
$country = $user?->address?->country;
```

### Match Expression (8.0)
```php
$status = match ($code) {
    200, 201 => 'success',
    400, 404 => 'client_error',
    500     => 'server_error',
    default => 'unknown',
};
```

### Constructor Property Promotion (8.0)
```php
class User
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
    ) {}
}
```

### Enums (8.1)
```php
enum Status: string
{
    case Draft = 'draft';
    case Published = 'published';
    case Archived = 'archived';
}
```

## Recommendation

Introduce one feature at a time in a small area of the code.  
Measure whether readability and safety actually improve before spreading it widely.
