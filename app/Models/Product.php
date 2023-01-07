<?php

namespace App\Models;

use App\Services\ProductService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public const VIP_DISCOUNT = 15;

    protected $table = 'content_type_products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @return string[]
     */
    public static function selectFields(): array
    {
        return [
            'id',
            'field_name_value as name',
            'field_price_value as price',
            'field_okdp_value as okdp',
            'visibility',
            'created_at'
        ];
    }

    /**
     * @return string
     */
    public function getPriceVipAttribute(): string
    {
        return ProductService::calculateVipPrice(price: $this->price);
    }
}
