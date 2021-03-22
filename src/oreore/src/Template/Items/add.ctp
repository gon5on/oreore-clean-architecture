<div class="items form large-9 medium-8 columns content">
<?= $this->Form->create($item, ['novalidate' => 'novalidate']) ?>
<fieldset>
<legend>商品追加</legend>
<?php
echo $this->Form->control('name', ['label' => '商品名']);
echo $this->Form->control('price', ['label' => '価格（税抜）']);
echo $this->Form->control('reduced_tax_rate_flag', ['label' => '軽減税率 対象商品']);
?>
</fieldset>
<?= $this->Form->button('保存') ?>
<?= $this->Form->end() ?>
</div>
