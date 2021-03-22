<?php

namespace App\Domain;

use Cake\Validation\Validator;

/**
 * 商品ドメインクラス
 */
class ItemDomain
{
    private const MAX_PEICE = 10000;
    private const ITEM_NAME_MAX_LENGTH = 30;

    /**
     * デフォルトバリデータ作成
     *
     * @return Validator バリデータ
     */
    public function createItemDefaultValidator(): Validator
    {
        $validator = new Validator();

        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->requirePresence('name', '不正な操作です')
            ->notBlank('name', '商品名を入力してください')
            ->maxLength('name', self::ITEM_NAME_MAX_LENGTH, '商品名は' . self::ITEM_NAME_MAX_LENGTH . '文字以内で入力してください');

        $validator
            ->requirePresence('price', '不正な操作です')
            ->notBlank('price', '税抜金額を入力してください')
            ->integer('price', '税抜金額は整数で入力してください')
            ->lessThanOrEqual('price', self::MAX_PEICE, '税抜金額は' . self::MAX_PEICE . '円以内で入力してください');

        $validator
            ->requirePresence('reduced_tax_rate_flag', '不正な操作です')
            ->boolean('reduced_tax_rate_flag', '軽減税率 対象商品のチェックが不正です');

        return $validator;
    }
}
