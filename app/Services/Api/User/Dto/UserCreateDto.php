<?php

declare(strict_types=1);

namespace App\Services\Api\User\Dto;

use Illuminate\Contracts\Support\Arrayable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class UserCreateDto implements Arrayable
{
    private readonly string $name;

    private readonly string $lastname;

    private readonly ?int $phone;

    private readonly ?string $email;

    private readonly ?string $birthday;

    private readonly UuidInterface $uuid;

    public static function fromArray(array $data): self
    {
        $instance = new  self();
        $instance->name = $data['name'];
        $instance->lastname = $data['lastname'];
        $instance->phone = $data['phone'] ?? null;
        $instance->email = $data['email'] ?? null;
        $instance->birthday = $data['birthday'] ?? null;
        $instance->uuid = Uuid::fromString($data['uuid']);

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
            'uuid' => $this->uuid->toString(),
        ];
    }

    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }
}
