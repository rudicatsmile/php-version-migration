<?php

declare(strict_types=1);

namespace App\Models;

class User
{
    /**
     * DTO Model User memanfaatkan fitur modern PHP 8 (Constructor Property Promotion, Strict Types, Readonly).
     */
    public function __construct(
        public readonly int $id,
        public readonly string $userId,
        public readonly string $username,
        public readonly string $role = 'operator',
        public readonly bool $isActive = true
    ) {}

    /**
     * Factory method untuk membuat instance User dari data array database.
     *
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: (int)($data['IDT'] ?? $data['id'] ?? 0),
            userId: (string)($data['User_ID'] ?? $data['user_id'] ?? ''),
            username: (string)($data['Nm_Lengkap'] ?? $data['username'] ?? ''),
            role: (string)($data['Level'] ?? $data['role'] ?? 'operator'),
            isActive: ($data['Active'] ?? 'Y') === 'Y'
        );
    }

    /**
     * Mengonversi instance ke bentuk array representasi.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->userId,
            'username' => $this->username,
            'role' => $this->role,
            'is_active' => $this->isActive
        ];
    }
}
