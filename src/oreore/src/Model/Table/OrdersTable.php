<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use App\Repository\IOrdersRepository;
use App\Model\Entity\Order;

/**
 * 売上モデル
 */
class OrdersTable extends Table implements IOrdersRepository
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('orders');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('OrderItems');
    }

    /**
     * 売上一覧
     *
     * @return array
     */
    public function list(): array
    {
        return $this->find('all')->order(['id' => 'desc'])->toArray();
    }

    /**
     * 売上追加
     *
     * @param Order $order 売上エンティティ
     * @return Order
     */
    public function add(Order $order): Order
    {
        return $this->save($order);
    }

    /**
     * 売上取得
     *
     * @param int $id 売上ID
     * @return Order
     */
    public function getOrder(int $id): ?Order
    {
        return $this->find('all')
            ->contain([
                'OrderItems' => function ($q) {
                    return $q->contain(['Items']);
                }
            ])
            ->where(['id' => $id])
            ->first();
    }
}
