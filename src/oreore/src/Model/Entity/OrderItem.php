<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * 売上商品エンティティ
 */
class OrderItem extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
