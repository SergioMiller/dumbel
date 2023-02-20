<?php
declare(strict_types=1);

namespace App\Services\Api\User\Dto;

use Illuminate\Contracts\Support\Arrayable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class UserCreateDto implements Arrayable
{
    private string $name;

    private string $lastname;

    private ?string $phone;

    private ?string $email;

    private ?string $birthday;

    private UuidInterface $uuid;

    public static function fromArray(array $data): self
    {
        $instance = new  self();
        $instance->name = $data['name'];
        $instance->lastname = $data['lastname'];
        $instance->phone = $data['phone'] ?? null;
        $instance->email = $data['email'] ?? null;
        $instance->birthday = $data['birthday'] ?? null;
        $instance->uuid = Uuid::fromString($data['birthday']);

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
            'uuid' => $this->uuid,
        ];
    }

    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }
}