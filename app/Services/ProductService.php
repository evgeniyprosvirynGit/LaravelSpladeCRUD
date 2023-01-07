<?php


namespace App\Services;

use App\Models\Product;

class ProductService
{
    /**
     * @param float $price
     *
     * @return string
     */
    public static function calculateVipPrice(float $price): string
    {
        $priceVipCoefficient = (100 - Product::VIP_DISCOUNT) / 100;

        return number_format($price * $priceVipCoefficient, 2, '.', '');
    }
}