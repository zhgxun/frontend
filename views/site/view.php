<?php

/* @var $this \yii\web\View */
/* @var $articles */

$this->title = $articles['title'];

?>
<h4><?php echo $articles['title']; ?></h4>
<p class="min-height">
    <small><?php echo \common\base\Navigation::getInstance()->getNameById($articles['type']); ?></small>
    <small><?php echo \common\base\User::getInstance()->getNameById($articles['userid']); ?></small>
    <small><?php echo $articles['readcount'] ? $articles['readcount'] : 0; ?></small>
    <small><?php echo date('Y-m-d H:i', $articles['ctime']); ?></small>
</p>
<div><?php echo $articles['content']; ?></div>
