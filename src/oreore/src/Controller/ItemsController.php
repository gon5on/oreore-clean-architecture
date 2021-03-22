<?php

namespace App\Controller;

use Cake\Datasource\Exception\RecordNotFoundException;
use RochaMarcelo\CakePimpleDi\Di\InvokeActionTrait;
use App\Controller\AppController;
use App\UseCase\IItemListUseCase;
use App\UseCase\IItemAddUseCase;
use App\UseCase\IItemEditUseCase;
use App\UseCase\IItemDeleteUseCase;
use App\Model\Entity\Item;

/**
 * 商品コントローラ
 */
class ItemsController extends AppController
{
    use InvokeActionTrait;

    /**
     * 商品一覧
     *
     * @param IItemListUseCase $itemListUseCase
     * @return void
     */
    public function index(IItemListUseCase $itemListUseCase)
    {
        $items = $itemListUseCase->itemList();

        $this->set(compact('items'));
    }

    /**
     * 商品追加
     *
     * @param IItemAddUseCase $itemAddUseCase
     * @return void
     */
    public function add(IItemAddUseCase $itemAddUseCase)
    {
        $item = new Item();

        if ($this->request->is('post')) {
            $item = $itemAddUseCase->addItem($this->request->getData());

            if (!$item->getErrors()) {
                $this->Flash->success('保存しました');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('エラーがあります');
            }
        }

        $this->set(compact('item'));
    }

    /**
     * 商品編集
     *
     * @param IItemEditUseCase $itemEditUseCase
     * @param string $id 商品ID
     * @return void
     */
    public function edit(IItemEditUseCase $itemEditUseCase, string $id = null)
    {
        try {
            $item = $itemEditUseCase->getItem($id);

            if ($this->request->is('put')) {
                $item = $itemEditUseCase->editItem($id, $this->request->getData());

                if (!$item->getErrors()) {
                    $this->Flash->success('保存しました');
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error('保存に失敗しました');
                }
            }

            $this->set(compact('item'));

        } catch (RecordNotFoundException $e) {
            $this->Flash->error('該当の商品がみつかりません');
            $this->redirect(['action' => 'index']);
        }
    }

    /**
     * 商品削除
     *
     * @param IItemDeleteUseCase $itemDeleteUseCase
     * @param string $id 商品ID
     * @return void
     */
    public function delete(IItemDeleteUseCase $itemDeleteUseCase, string $id = null)
    {
        $this->request->allowMethod(['post']);

        try {
            if ($itemDeleteUseCase->deleteItem($id)) {
                $this->Flash->success('削除しました');
            } else {
                $this->Flash->error('削除に失敗しました');
            }
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('該当の商品がみつかりません');
        }

        return $this->redirect(['action' => 'index']);
    }
}
