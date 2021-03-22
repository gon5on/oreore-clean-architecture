<?php

namespace App\UseCase;

/**
 * 商品削除ユースケース
 */
interface IItemDeleteUseCase
{
    /**
     * 商品削除
     *
     * @param string $id 商品ID
     * @return bool
     */
    public function deleteItem(string $id): bool;
}
