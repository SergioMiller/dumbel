<?php

declare(strict_types=1);

namespace App\Services\Api\User\Dto;

use Illuminate\Contracts\Support\Arrayable;

final class UserCreateDto implements Arrayable
{
    private readonly string $name;

    private readonly string $lastname;

    private readonly int|null $phone;

    private readonly string|null $email;

    private readonly string|null $birthday;

    public static function fromArray(array $data): self
    {
        $instance = new self();
        $instance->name = $data['name'];
        $instance->lastname = $data['lastname'];
        $instance->phone = $data['phone'] ?? null;
        $instance->email = $data['email'] ?? null;
        $instance->birthday = $data['birthday'] ?? null;

        return $instance;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'lastname' => $this->lastname,
            'phone' => $this->phone,
            'email' => $this->email,
            'birthday' => $this->birthday,
        ];
    }
}
