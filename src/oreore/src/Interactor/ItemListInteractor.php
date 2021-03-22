<?php

namespace App\Interactor;

use App\UseCase\IItemListUseCase;
use App\Repository\IItemsRepository;

/**
 * 商品一覧インタラクタ
 */
class ItemListInteractor implements IItemListUseCase
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
     * 商品一覧
     *
     * @return array
     */
    public function itemList(): array
    {
        return $this->itemsRepository->list();
    }
}
