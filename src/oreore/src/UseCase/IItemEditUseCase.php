<?php

namespace App\UseCase;

use App\Model\Entity\Item;

/**
 * 商品編集ユースケース
 */
interface IItemEditUseCase
{
    /**
     * 商品取得
     *
     * @param string $id 商品ID
     * @return Item
     */
    public function getItem(string $id): Item;

    /**
     * 商品編集
     *
     * @param string $id 商品ID
     * @param array $data
     * @return Item
     */
    public function editItem(string $id, array $data): Item;
}
