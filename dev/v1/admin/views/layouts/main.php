<?php
use yii\helpers\Html;
$assets_version =  Yii::$app->params['assets_version'];
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <?= Html::csrfMetaTags() ?>
    <title>控制台 - 雅爱Mall</title>
    <link rel="stylesheet" href="/css/bootstrap.css" />
    <link rel="stylesheet" href="/css/font-awesome.min.css" />
    <?php if(!empty($this->context->cssfiles['plugin'])):foreach($this->context->cssfiles['plugin'] as $v):?>
    <link rel="stylesheet" href="/plugin/<?= $v?>.css?v=<?= time()?>">
    <?php endforeach;endif;?>
    <link rel="stylesheet" href="/css/main.css?v=<?= $assets_version?>">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?= $this->render('navbar')?>
<div class="main">
    <?= $this->render('menu')?>
    <div class="page-content"></div>
</div>
<!--[if !IE]> -->
<script src="/js/jquery-2.0.3.min.js"></script>
<!-- <![endif]-->
<!--[if IE]>
<script src="/js/jquery-1.10.2.min.js"></script>
<![endif]-->
<script src="/js/bootstrap.min.js"></script>
<script src="/plugin/layer/layer.js"></script>
<?php if(!empty($this->context->jsfiles['plugin'])):foreach($this->context->jsfiles['plugin'] as $v):?>
<script src="/plugin/<?= $v?>.js?v=<?= time()?>"></script>
<?php endforeach;endif;?>
<script src="/js/ace.min.js?v=<?= $assets_version?>"></script>
<script src="/js/base.js?v=<?= $assets_version?>"></script>
<?php if(!empty($this->context->jsfiles)):foreach($this->context->jsfiles as $k=>$v):if($k!=='plugin'):?>
<script src="/js/<?= $v?>.js?v=$assets_version?>"></script>
<?php endif;endforeach;endif;?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
