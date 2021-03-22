<?php

namespace App\Interactor;

use Cake\Datasource\Exception\RecordNotFoundException;
use App\UseCase\IItemDeleteUseCase;
use App\Repository\IitemsRepository;

/**
 * 商品削除インタラクタ
 */
class ItemDeleteInteractor implements IItemDeleteUseCase
{
    private $itemsRepository;

    /**
     * コンストラクタ
     *
     * @param IItemsRepository $itemsRepository
     */
    public function __construct(IItemsRepository $itemsRepository)
    {
        $this->itemsRepository = $itemsRepository;
    }

    /**
     * 商品削除
     *
     * @param string $id 商品ID
     * @return bool
     */
    public function deleteItem(string $id): bool
    {
        if (!preg_match('/^\d+$/', $id)) {
            throw new \InvalidArgumentException('不正な操作です');
        }

        if (!$this->itemsRepository->getItem($id)) {
            throw new RecordNotFoundException('商品が見つかりません');
        }

        return $this->itemsRepository->del($id);
    }
}
