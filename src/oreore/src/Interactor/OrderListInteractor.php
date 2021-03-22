<?php

namespace App\Interactor;

use App\UseCase\IOrderListUseCase;
use App\Repository\IOrdersRepository;

/**
 * 売上一覧インタラクタ
 */
class OrderListInteractor implements IOrderListUseCase
{
    private $ordersRepository;

    /**
     * コンストラクタ
     *
     * @param IOrdersRepository $ordersRepository
     */
    public function __construct(IOrdersRepository $ordersRepository)
    {
        $this->ordersRepository = $ordersRepository;
    }

    /**
     * 売上一覧
     *
     * @return array
     */
    public function orderList(): array
    {
        return $this->ordersRepository->list();
    }
}
