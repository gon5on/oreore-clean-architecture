<?php

namespace App\UseCase;

/**
 * 売上一覧ユースケース
 */
interface IOrderListUseCase
{
    /**
     * 売上一覧
     *
     * @return array
     */
    public function orderList(): array;
}
