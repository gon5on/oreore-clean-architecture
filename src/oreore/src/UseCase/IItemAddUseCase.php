<?php

namespace App\UseCase;

use App\Model\Entity\Item;

/**
 * 商品追加ユースケース
 */
interface IItemAddUseCase
{
    /**
     * 商品追加
     *
     * @param array $data
     * @return Item
     */
    public function addItem(array $data): Item;
}
