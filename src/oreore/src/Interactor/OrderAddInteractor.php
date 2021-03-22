<?php

namespace App\Interactor;

use Cake\Utility\Hash;
use App\UseCase\IOrderAddUseCase;
use App\Repository\IOrdersRepository;
use App\Repository\IItemsRepository;
use App\Domain\OrderDomain;
use App\Model\Entity\Order;

/**
 * 売上追加インタラクタ
 */
class OrderAddInteractor implements IOrderAddUseCase
{
    private $ordersRepository;
    private $itemsRepository;

    /**
     * コンストラクタ
     *
     * @param IOrdersRepository $ordersRepository
     * @param IItemsRepository $itemsRepository
     */
    public function __construct(IOrdersRepository $ordersRepository, IItemsRepository $itemsRepository)
    {
        $this->ordersRepository = $ordersRepository;
        $this->itemsRepository = $itemsRepository;
    }

    /**
     * 売上追加
     *
     * @param array $data
     * @return Order
     */
    public function addOrder(array $data): Order
    {
        $order = $this->__validation($data);

        if ($order->getErrors()) {
            return $order;
        }

        // 各商品の税込金額をセット
        $items = $this->itemsRepository->list();
        $include_tax_prices = Hash::combine($items, '{n}.id', '{n}.include_tax_price');

        foreach ($order->order_items as $key => $order_item) {
            $order->order_items[$key]->include_tax_price = Hash::get($include_tax_prices, $order_item->item_id);
        }

        // 合計金額を計算
        $orderDomain = new OrderDomain();
        $order->total = $orderDomain->calcTotalPrice($order->order_items);

        // 保存
        $this->ordersRepository->add($order);

        return $order;
    }

    /**
     * 商品一覧
     *
     * @return array $items
     */
    public function itemList(): array
    {
        $items = $this->itemsRepository->list();

        return $items;
    }

    /**
     * バリデーション
     *
     * @param array $data
     * @return Order $order
     */
    private function __validation(array $data): Order
    {
        $order = $this->ordersRepository->newEntity($data);

        // //全数量が未入力ではないか？
        // $result = Hash::remove($data, 'order_items.{n}[quantity=0]');

        // $orderDomain = new OrderDomain();
        // $quantities = Hash::extract($data, 'order_items.{n}.quantity');

        // if (!$orderDomain->hogehoge($quantities)) {
        //     foreach ($order->order_items as $order_item) {
        //         $order_item->setErrors(['quatity' => ['all_empty' => '最低1つに数量を入力してください']]);
        //     }
        // }

        return $order;
    }
}
