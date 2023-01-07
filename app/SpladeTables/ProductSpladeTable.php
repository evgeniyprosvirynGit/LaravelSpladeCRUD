<?php

namespace App\SpladeTables;

use Illuminate\Pagination\LengthAwarePaginator;
use ProtoneMedia\Splade\SpladeQueryBuilder;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\Table\HasColumns;
use ProtoneMedia\Splade\Table\HasFilters;
use ProtoneMedia\Splade\Table\HasResource;
use ProtoneMedia\Splade\Table\HasSearchInputs;
use Spatie\QueryBuilder\QueryBuilder;

class ProductSpladeTable
{
    public const PER_PAGE_DEFAULT = 15;

    public static function create(QueryBuilder|LengthAwarePaginator $products): HasSearchInputs|HasColumns|SpladeQueryBuilder|SpladeTable|HasFilters|ProductSpladeTable|HasResource
    {
        return SpladeTable::for($products)
            ->defaultSort('created_at', 'desc')
            ->withGlobalSearch()
            ->column('name', 'Name', sortable: true, searchable: true)
            ->column('price', 'Price', sortable: true, searchable: true)
            ->column('priceVip', 'Price Vip', sortable: false,)
            ->column('okdp', 'OKDP', sortable: true)
            ->column('visibility', 'Visibility', sortable: true)
            ->column('created_at', 'Created', sortable: true)
            ->column('action')
            ->selectFilter(
                key: 'visibility',
                options: [
                true => 'Yes',
                false => 'No',
            ],
                label: 'visibility'
            );
    }
}