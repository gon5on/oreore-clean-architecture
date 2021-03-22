<?php

namespace App\UseCase;

use App\Model\Entity\Order;

/**
 * 売上詳細ユースケース
 */
interface IOrderViewUseCase
{
    /**
     * 売上取得
     *
     * @param string $id 売上ID
     * @return Order
     */
    public function getOrder(string $id): Order;
}
