<nav class="large-3 medium-4 columns" id="actions-sidebar">
<ul class="side-nav">
<li><?= $this->Html->link('売上追加', ['controller' => 'Orders', 'action' => 'add']) ?></li>
<li><?= $this->Html->link('売上一覧', ['controller' => 'Orders', 'action' => 'index']) ?></li>
<hr>
<li><?= $this->Html->link('商品追加', ['controller' => 'Items', 'action' => 'add']) ?></li>
<li><?= $this->Html->link('商品一覧', ['controller' => 'Items', 'action' => 'index']) ?></li>
</ul>
</nav>