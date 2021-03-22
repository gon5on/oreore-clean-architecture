<div class="items form large-9 medium-8 columns content">
<fieldset>
<legend>売上詳細</legend>

<table cellpadding="0" cellspacing="0">
<tr>
<th>売上ID</th>
<td><?= $order->id ?></td>
</tr>
<tr>
<th>売上日時</th>
<td><?= $order->created->i18nFormat('yyyy/MM/dd HH:mm:ss') ?>
</tr>
<tr>
<th>合計金額（税込）</th>
<td><?= $this->Number->format($order->total) ?>円</td>
</tr>
</table>

<table cellpadding="0" cellspacing="0">
<thead>
<tr>
<th scope="col">商品ID</th>
<th scope="col">商品名</th>
<th scope="col">価格（税込）</th>
<th scope="col">数量</th>
</tr>
</thead>

<tbody>
<?php foreach ($order->order_items as $order_item): ?>
<tr>
<td><?= $order_item->item_id ?></td>
<td><?= $order_item->item->name ?></td>
<td><?= $order_item->include_tax_price ?>円</td>
<td><?= $order_item->quantity ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>


</fieldset>
</div>
