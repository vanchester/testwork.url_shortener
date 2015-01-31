<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="en">

    <link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl; ?>/css/main.css">

    <title><?= CHtml::encode($this->pageTitle); ?></title>

    <script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/main.js"></script>
</head>

<body>

<div class="container" id="page">
    <div id="content" class="form">
        <?= $content; ?>
    </div>
</div>

</body>
</html>
