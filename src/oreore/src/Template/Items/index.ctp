<div class="items index large-9 medium-8 columns content">
<h3>商品一覧</h3>

<table cellpadding="0" cellspacing="0">
<thead>
<tr>
<th scope="col">商品ID</th>
<th scope="col">商品名</th>
<th scope="col">価格（税抜）</th>
<th scope="col">価格（税込）</th>
<th scope="col">軽減税率</th>
<th scope="col" class="actions">操作</th>
</tr>
</thead>

<tbody>
<?php foreach ($items as $item): ?>
<tr>
<td><?= $item->id ?></td>
<td><?= h($item->name) ?></td>
<td><?= $this->Number->format($item->price) ?>円</td>
<td><?= $this->Number->format($item->include_tax_price) ?>円</td>
<td><?= ($item->reduced_tax_rate_flag) ? '対象' : '' ?></td>
<td class="actions">
<?= $this->Html->link('編集', ['action' => 'edit', $item->id]) ?>&nbsp;
<?= $this->Form->postLink('削除', ['action' => 'delete', $item->id], ['confirm' => '削除してよろしいですか？']) ?>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

</div>
