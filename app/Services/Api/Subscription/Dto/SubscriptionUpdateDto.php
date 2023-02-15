<?php
declare(strict_types=1);

namespace App\Services\Api\Subscription\Dto;

use Illuminate\Contracts\Support\Arrayable;

final class SubscriptionUpdateDto implements Arrayable
{
    private string $name;

    private int $day_quantity;

    private int $works_from;

    private int $works_to;

    private ?int $training_quantity;

    private ?int $price;

    public static function fromArray(array $data): self
    {
        $instance = new  self();
        $instance->name = $data['name'];
        $instance->day_quantity = $data['day_quantity'];
        $instance->works_from = $data['works_from'];
        $instance->works_to = $data['works_to'];
        $instance->training_quantity = $data['training_quantity'] ?? null;
        $instance->price = $data['price'] ?? null;

        return $instance;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'day_quantity' => $this->day_quantity,
            'works_from' => $this->works_from,
            'works_to' => $this->works_to,
            'training_quantity' => $this->training_quantity,
            'price' => $this->price,
        ];
    }
}
