<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap\ActiveForm;

AppAsset::register($this);

$keyword = isset($_GET['keyword']) && trim(strip_tags($_GET['keyword'])) ? trim(strip_tags($_GET['keyword'])) : '请输入标题';

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
        NavBar::begin([
            'brandLabel' => '小步',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
//        $menuItems = [
//            ['label' => '读书', 'url' => ['/site/index', 'type' => 1]],
//            ['label' => '旅行', 'url' => ['/site/index', 'type' => 2]],
//            ['label' => 'PHP', 'url' => ['/site/index', 'type' => 3]],
//        ];
        $menuItems = \common\base\Navigation::getInstance()->getMenuItems();
        if (Yii::$app->user->isGuest) {
            //$menuItems[] = ['label' => '注册', 'url' => ['/site/signup']];
            //$menuItems[] = ['label' => '登录', 'url' => ['/site/login']];
        } else {
//            $menuItems[] = [
//                'label' => '退出 (' . Yii::$app->user->identity->username . ')',
//                'url' => ['/site/logout'],
//                'linkOptions' => ['data-method' => 'post']
//            ];
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-left'],
            'items' => $menuItems,
        ]);

        NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">
            <small>&copy;<?php echo ' 2015 - ' . date('Y') ?> 小步</small>
            <small><a href="https://github.com/zhgxun" target="_blank">GitHub</a></small>
        </p>
        <p class="pull-right"><small><?php echo Yii::powered() ?></small></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
