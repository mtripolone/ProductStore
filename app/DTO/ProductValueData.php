<?php

namespace App\DTO;

use App\DTO\Contract\DTOContract;

final class ProductValueData implements DTOContract
{
    public function __construct(
        public string $title,
        public float  $price,
        public string $description,
        public string $category,
        public string $image
    )
    {
    }

    public static function fromRequest(array $request): ProductValueData
    {
        return new self(
            $request['title'],
            $request['price'],
            $request['description'],
            $request['category'],
            $request['image']
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->title,
            'price' => $this->price,
            'description' => $this->description,
            'category' => $this->category,
            'image_url' => $this->image
        ];
    }
}
