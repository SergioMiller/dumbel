<?php
declare(strict_types=1);

namespace App\Services\Api\Gym\Dto;

use Illuminate\Contracts\Support\Arrayable;

final class GymUpdateDto implements Arrayable
{
    private string $name;

    private ?string $description;

    private ?int $phone;

    private ?string $email;

    private string $address;

    public static function fromArray(array $data): self
    {
        $instance = new  self();
        $instance->name = $data['name'];
        $instance->description = $data['description'] ?? null;
        $instance->phone = $data['phone'] ?? null;
        $instance->email = $data['email'] ?? null;
        $instance->address = $data['address'];

        return $instance;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
        ];
    }
}
