<?php

namespace App\Domain;

use Cake\Validation\Validator;

/**
 * 売上ドメインクラス
 */
class OrderDomain
{
    private const TAX = 0.1;            //税率10％
    private const REDUCED_TAX = 0.08;   //軽減税率8％

    private const MAX_QUANTITY = 100;   //1つの製品に対する最大注文個数

    /**
     * 税込金額を計算する
     *
     * @param int $price 税抜金額
     * @param bool reduced_tax_rate_flag 軽減税率フラグ
     * @return int 税込金額
     */
    public function calcIncludeTaxPrice($price, $reduced_tax_rate_flag): int
    {
        $tax = ($reduced_tax_rate_flag) ? self::REDUCED_TAX : self::TAX;

        return round($price + ($price * $tax));
    }

    /**
     * 小計金額を計算する
     *
     * @param int $include_tax_price 税込金額
     * @param int $quantity 数量
     * @return int 小計金額
     */
    public function calcSubtotalPrice($include_tax_price, $quantity): int
    {
        return $include_tax_price * $quantity;
    }

    /**
     * 合計金額を計算する
     *
     * @param array $order_items 売上商品一覧
     * @return int 合計金額
     */
    public function calcTotalPrice($order_items): int
    {
        $total = 0;

        foreach ($order_items as $order_item) {
            $total += $this->calcSubtotalPrice($order_item->include_tax_price, $order_item->quantity);
        }

        return $total;
    }

    /**
     * 注文製品デフォルトバリデータ作成
     *
     * @return Validator バリデータ
     */
    public function createOrderItemDefaultValidator(): Validator
    {
        $validator = new Validator();

        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->requirePresence('item_id', '不正な操作です')
            ->notBlank('item_id', '製品IDが空です')
            ->integer('item_id', '製品IDは数字で入力してください');

        $validator
            ->requirePresence('quantity', '不正な操作です')
            ->notBlank('quantity', '数量を入力してください')
            ->integer('quantity', '数量は整数で入力してください')
            ->lessThanOrEqual('quantity', self::MAX_QUANTITY, '数量は' . self::MAX_QUANTITY . '以内で入力してください');

        return $validator;
    }
}
