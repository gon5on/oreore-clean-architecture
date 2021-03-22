<!DOCTYPE html>
<html>
<head>
<?= $this->Html->charset() ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>売上管理システム</title>
<?= $this->Html->meta('icon') ?>

<?= $this->Html->css('base.css') ?>
<?= $this->Html->css('style.css') ?>

<?= $this->fetch('meta') ?>
<?= $this->fetch('css') ?>
<?= $this->fetch('script') ?>
</head>

<body>
<nav class="top-bar expanded" data-topbar role="navigation">
<ul class="title-area large-3 medium-4 columns">
<li class="name">
<h1><a href="">売上管理システム</a></h1>
</li>
</ul>
</nav>

<?= $this->Flash->render() ?>

<div class="container clearfix">
<?= $this->element('menu') ?>
<?= $this->fetch('content') ?>
</div>

<footer>
</footer>

</body>
</html>
