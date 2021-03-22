<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Domain\OrderDomain;

/**
 * 売上内訳商品モデル
 */
class OrderItemsTable extends Table
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

        $this->setTable('order_items');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Items');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        return (new OrderDomain())->createOrderItemDefaultValidator();
    }
}
