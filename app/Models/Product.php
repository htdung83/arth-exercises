<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public const PRICE_PRECISION = 2;

    protected $fillable = [
        'product_name',
        'product_image',
        'description',
        'price',
        'stock'
    ];

    // Business Logics
    public function discount(float $amount): void
    {
        if ($amount <= 0) {
            throw new \InvalidArgumentException('Discount amount must be greater than 0');
        }

        if ($this->price > 0) {
            $this->price -= round($amount, self::PRICE_PRECISION);
        }
    }

    public function isInStock(int $amount): bool
    {
        if ($amount <= 0) {
            throw new \InvalidArgumentException('Number of Product must be greater than 0');
        }

        if ($this->stock > 0 && $amount <= $this->stock) {
            return true;
        }

        return false;
    }
}
