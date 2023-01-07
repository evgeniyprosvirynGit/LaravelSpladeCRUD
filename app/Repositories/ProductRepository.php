<?php

namespace App\Repositories;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Support\Collection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductRepository implements ProductRepositoryInterface
{
    private ProductRequest $request;

    /**
     * @param ProductRequest $request
     */
    public function setRequest(ProductRequest $request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     *
     * @return QueryBuilder
     */
    public function all(): QueryBuilder
    {
        $queryBuilder = QueryBuilder::for(Product::class)
            ->select(columns: Product::selectFields());

        $queryBuilder->defaultSort('-created_at');

        $queryBuilder->allowedSorts($this->sorts());
        $queryBuilder->allowedFilters($this->filters());

        return $queryBuilder;
    }

    /**
     * @param int $productId
     *
     * @return mixed
     */
    public function findById(int $productId)
    {
        return Product::where('id', $productId)
            ->firstOrFail();
    }

    /**
     * @param int $productId
     */
    public function update(int $productId)
    {
        $product = Product::where('id', $productId)->firstOrFail();
        $product->update($this->request->validationData());
    }


    /**
     * @return mixed
     */
    public function create(): mixed
    {
        $product = new Product();
        $product->fill($this->request->validationData());
        $product->save();

        return $product->id;
    }

    /**
     * @return array
     */
    public function filters(): array
    {
        return [
            AllowedFilter::exact('name', 'field_name_value'),
            AllowedFilter::exact('price', 'field_price_value'),
            AllowedFilter::exact('visibility', 'visibility'),
            $this->globalSearch(),
        ];
    }

    /**
     * @return string[]
     */
    public function sorts(): array
    {
        return ['name', 'price', 'okdp', 'visibility', 'created_at'];
    }


    /**
     * @param int $productId
     *
     * @return mixed
     */
    public function delete(int $productId)
    {
        $product = Product::where('id', $productId)->firstOrFail();

        return $product->delete();
    }

    /**
     * @return AllowedFilter
     */
    private function globalSearch(): AllowedFilter
    {
        return AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query->orWhere('field_name_value', 'LIKE', "%{$value}%");
                    $query->orWhere('field_okdp_value', 'LIKE', "%{$value}%");
                });
            });
        });
    }
}