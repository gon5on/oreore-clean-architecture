<div class="items index large-9 medium-8 columns content">
<h3>売上一覧</h3>

<table cellpadding="0" cellspacing="0">
<thead>
<tr>
<th scope="col">売上ID</th>
<th scope="col">売上日時</th>
<th scope="col">合計金額（税込）</th>
<th scope="col" class="actions">操作</th>
</tr>
</thead>

<tbody>
<?php foreach ($orders as $order): ?>
<tr>
<td><?= $order->id ?></td>
<td><?= $order->created->i18nFormat('yyyy/MM/dd HH:mm:ss') ?></td>
<td><?= $this->Number->format($order->total) ?>円</td>
<td class="actions">
<?= $this->Html->link('詳細', ['action' => 'view', $order->id]) ?>&nbsp;
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

</div>
