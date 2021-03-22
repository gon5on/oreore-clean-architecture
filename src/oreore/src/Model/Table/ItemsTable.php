<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Repository\IItemsRepository;
use App\Domain\OrderDomain;
use App\Domain\ItemDomain;
use App\Model\Entity\Item;

/**
 * 商品モデル
 */
class ItemsTable extends Table implements IItemsRepository
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

        $this->setTable('items');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        return (new ItemDomain())->createItemDefaultValidator();
    }

    /**
     * 商品一覧
     *
     * @return array
     */
    public function list(): array
    {
        $items = $this->find('all')->where(['deleted IS null'])->order(['id' => 'desc'])->toArray();

        if ($items) {
            $orderDomain = new OrderDomain();

            foreach ($items as $key => $item) {
                $include_tax_price = $orderDomain->calcIncludeTaxPrice($item->price, $item->reduced_tax_rate_flag);
                $items[$key]->include_tax_price = $include_tax_price;
            }
        }

        return $items;
    }

    /**
     * 商品追加
     *
     * @param Item $item 商品エンティティ
     * @return Item
     */
    public function add(Item $item): Item
    {
        return $this->save($item);
    }

    /**
     * 商品編集
     *
     * @param Item $item 商品エンティティ
     * @return Item
     */
    public function edit(Item $item): Item
    {
        return $this->save($item);
    }

    /**
     * 商品削除
     *
     * @param int $id 商品ID
     * @return bool
     */
    public function del(int $id): bool
    {
        return $this->delete($this->get($id));
    }

    /**
     * 商品取得
     *
     * @param int $id 商品ID
     * @return Item
     */
    public function getItem(int $id): ?Item
    {
        return $this->find('all')->where(['id' => $id, 'deleted IS null'])->first();
    }
}
