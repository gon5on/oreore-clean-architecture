<?php

use Cake\ORM\TableRegistry;

return [
    'CakePimpleDi' => [
        'actionInjections' => [
            '\App\Controller\OrdersController' => [
                'index' => ['orderListUseCase'],
                'view' => ['orderViewUseCase'],
                'add' => ['orderAddUseCase'],
            ],
            '\App\Controller\ItemsController' => [
                'index' => ['itemListUseCase'],
                'add' => ['itemAddUseCase'],
                'edit' => ['itemEditUseCase'],
                'delete' => ['itemDeleteUseCase'],
            ],
        ],
        'services' => [
            /**
             * Use Case
             */
            'orderListUseCase' => function ($c) {
                return new App\Interactor\OrderListInteractor(
                    $c['ordersRepository'],
                );
            },
            'orderViewUseCase' => function ($c) {
                return new App\Interactor\OrderViewInteractor(
                    $c['ordersRepository'],
                );
            },
            'orderAddUseCase' => function ($c) {
                return new App\Interactor\OrderAddInteractor(
                    $c['ordersRepository'],
                    $c['itemsRepository'],
                );
            },

            'itemListUseCase' => function ($c) {
                return new App\Interactor\ItemListInteractor(
                    $c['itemsRepository'],
                );
            },
            'itemAddUseCase' => function ($c) {
                return new App\Interactor\ItemAddInteractor(
                    $c['itemsRepository'],
                );
            },
            'itemEditUseCase' => function ($c) {
                return new App\Interactor\ItemEditInteractor(
                    $c['itemsRepository'],
                );
            },
            'itemDeleteUseCase' => function ($c) {
                return new App\Interactor\ItemDeleteInteractor(
                    $c['itemsRepository'],
                );
            },

            /**
             * Repository
             */
            'ordersRepository' => function () {
                return TableRegistry::getTableLocator()->get('Orders');
            },
            'itemsRepository' => function () {
                return TableRegistry::getTableLocator()->get('Items');
            },
        ]
    ]
];
