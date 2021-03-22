<?php

namespace App\Interactor;

use Cake\Datasource\Exception\RecordNotFoundException;
use App\UseCase\IItemEditUseCase;
use App\Repository\IitemsRepository;
use App\Model\Entity\Item;

/**
 * 商品編集インタラクタ
 */
class ItemEditInteractor implements IItemEditUseCase
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
     * 商品取得
     *
     * @param string $id 商品ID
     * @return Item
     */
    public function getItem(string $id): Item
    {
        if (!preg_match('/^\d+$/', $id)) {
            throw new \InvalidArgumentException('不正な操作です');
        }

        $item = $this->itemsRepository->getItem($id);

        if (!$item) {
            throw new RecordNotFoundException('商品が見つかりません');
        }

        return $item;
    }

    /**
     * 商品編集
     *
     * @param string $id 商品ID
     * @param array $data
     * @return Item
     */
    public function editItem(string $id, array $data): Item
    {
        if (!preg_match('/^\d+$/', $id)) {
            throw new \InvalidArgumentException('不正な操作です');
        }

        $item = $this->itemsRepository->getItem($id);

        if (!$item) {
            throw new RecordNotFoundException('商品が見つかりません');
        }

        // バリデーション
        $item = $this->itemsRepository->patchEntity($item, $data);

        if (!$item->getErrors()) {
            // エラーが無ければ保存
            $this->itemsRepository->edit($item);
        }

        return $item;
    }
}
