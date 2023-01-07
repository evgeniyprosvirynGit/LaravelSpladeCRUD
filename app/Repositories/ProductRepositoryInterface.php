<?php

namespace App\Repositories;

use App\Http\Requests\ProductRequest;
use Spatie\QueryBuilder\QueryBuilder;

interface ProductRepositoryInterface
{
    /**
     * @param ProductRequest $request
     */
    public function setRequest(ProductRequest $request);

    /**
     *
     * @return QueryBuilder
     */
    public function all(): QueryBuilder;

    /**
     * @param int $productId
     *
     * @return mixed
     */
    public function findById(int $productId);

    /**
     * @param int $productId
     */
    public function update(int $productId);

    /**
     * @return array
     */
    public function filters(): array;

    /**
     * @return string[]
     */
    public function sorts(): array;

    /**
     * @return mixed
     */
    public function create(): mixed;
}