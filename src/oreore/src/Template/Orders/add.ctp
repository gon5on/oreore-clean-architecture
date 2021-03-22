<div class="items form large-9 medium-8 columns content">
<?= $this->Form->create($order, ['novalidate' => 'novalidate']) ?>
<fieldset>
<legend>売上追加</legend>
<?php
foreach ($items as $key => $item) {
    $label = "▼ {$item->name}（税込：{$this->Number->format($item->include_tax_price)}円）　数量";
    echo $this->Form->control("order_items[{$key}][quantity]", ['label' => $label]);
    echo $this->Form->hidden("order_items[{$key}][item_id]", ['value' => $item->id]);
}
?>
</fieldset>
<?= $this->Form->button('保存') ?>
<?= $this->Form->end() ?>
</div>
