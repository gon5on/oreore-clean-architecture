<?php

namespace App\Repository;

use App\Model\Entity\Order;

/**
 * 売上リポジトリ
 */
interface IOrdersRepository
{
    /**
     * 売上一覧
     *
     * @return array
     */
    public function list(): array;

    /**
     * 売上追加
     *
     * @param Order $order エンティティ
     * @return Order
     */
    public function add(Order $order): Order;

    /**
     * 売上取得
     *
     * @param int $id 売上ID
     * @return Order
     */
    public function getOrder(int $id): ?Order;
}
