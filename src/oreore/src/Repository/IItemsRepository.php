<?php

namespace App\Repository;

use App\Model\Entity\Item;

/**
 * 商品リポジトリ
 */
interface IItemsRepository
{
    /**
     * 商品一覧
     *
     * @return array
     */
    public function list(): array;

    /**
     * 商品追加
     *
     * @param Item $item 商品エンティティ
     * @return Item
     */
    public function add(Item $item): Item;

    /**
     * 商品編集
     *
     * @param Item $item 商品エンティティ
     * @return Item
     */
    public function edit(Item $item): Item;

    /**
     * 商品削除
     *
     * @param int $id 商品ID
     * @return bool
     */
    public function del(int $id): bool;

    /**
     * 商品取得
     *
     * @param int $id 商品ID
     * @return Item
     */
    public function getItem(int $id): ?Item;
}
