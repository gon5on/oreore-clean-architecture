<?php

namespace App\UseCase;

/**
 * 商品一覧ユースケース
 */
interface IItemListUseCase
{
    /**
     * 商品一覧
     *
     * @return array
     */
    public function itemList(): array;
}
