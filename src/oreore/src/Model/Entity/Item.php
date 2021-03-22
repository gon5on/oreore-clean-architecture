<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * 商品エンティティ
 */
class Item extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
