<?php

namespace App\Controller;

use Cake\Datasource\Exception\RecordNotFoundException;
use RochaMarcelo\CakePimpleDi\Di\InvokeActionTrait;
use App\Controller\AppController;
use App\UseCase\IOrderListUseCase;
use App\UseCase\IOrderAddUseCase;
use App\UseCase\IOrderViewUseCase;
use App\Model\Entity\Order;

/**
 * 売上コントローラ
 */
class OrdersController extends AppController
{
    use InvokeActionTrait;

    /**
     * 売上一覧
     *
     * @param IOrderListUseCase $orderListUseCase
     * @return void
     */
    public function index(IOrderListUseCase $orderListUseCase)
    {
        $orders = $orderListUseCase->orderList();

        $this->set(compact('orders'));
    }

    /**
     * 売上追加
     *
     * @param IOrderAddUseCase $orderAddUseCase
     * @return void
     */
    public function add(IOrderAddUseCase $orderAddUseCase)
    {
        $order = new Order();
        $items = $orderAddUseCase->itemList();

        if ($this->request->is('post')) {
            $order = $orderAddUseCase->addOrder($this->request->getData());

            if (!$order->getErrors()) {
                $this->Flash->success('保存しました');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('エラーがあります');
            }
        }

        $this->set(compact('order', 'items'));
    }

    /**
     * 売上詳細
     *
     * @param IOrderViewUseCase $orderViewUseCase
     * @param string $id 商品ID
     * @return void
     */
    public function view(IOrderViewUseCase $orderViewUseCase, string $id)
    {
        try {
            $order = $orderViewUseCase->getOrder($id);

            $this->set(compact('order'));
        } catch (\InvalidArgumentException | RecordNotFoundException $e) {
            $this->Flash->error($e->getMessage());
            $this->redirect(['action' => 'index']);
        }
    }
}
