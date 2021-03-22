<?php

namespace App\Interactor;

use App\UseCase\IItemAddUseCase;
use App\Repository\IitemsRepository;
use App\Model\Entity\Item;

/**
 * 商品追加インタラクタ
 */
class ItemAddInteractor implements IItemAddUseCase
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
     * 商品追加
     *
     * @param array $data
     * @return Item
     */
    public function addItem(array $data): Item
    {
        // バリデーション
        $item = $this->itemsRepository->newEntity($data);

        if (!$item->getErrors()) {
            // エラーが無ければ保存
            $this->itemsRepository->add($item);
        }

        return $item;
    }
}
