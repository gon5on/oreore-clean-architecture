<?php

namespace App\Interactor;

use Cake\Datasource\Exception\RecordNotFoundException;
use App\UseCase\IOrderViewUseCase;
use App\Repository\IOrdersRepository;
use App\Model\Entity\Order;

/**
 * 売上詳細インタラクタ
 */
class OrderViewInteractor implements IOrderViewUseCase
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
     * 売上取得
     *
     * @param string $id 売上ID
     * @return Order
     */
    public function getOrder(string $id): Order
    {
        if (!preg_match('/^\d+$/', $id)) {
            throw new \InvalidArgumentException('不正な操作です');
        }

        $order = $this->ordersRepository->getOrder($id);

        if (!$order) {
            throw new RecordNotFoundException('売上が見つかりません');
        }

        return $order;
    }
}
