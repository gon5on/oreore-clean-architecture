<?php

namespace App\UseCase;

use App\Model\Entity\Order;

/**
 * 売上追加ユースケース
 */
interface IOrderAddUseCase
{
    /**
     * 売上追加
     *
     * @param array $data
     * @return Order
     */
    public function addOrder(array $data): Order;

    /**
     * 商品一覧
     *
     * @return array
     */
    public function itemList(): array;
}
