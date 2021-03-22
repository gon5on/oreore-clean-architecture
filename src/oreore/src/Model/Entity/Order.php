<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * 売上エンティティ
 */
class Order extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
