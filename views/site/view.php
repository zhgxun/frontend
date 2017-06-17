<?php

/* @var $this \yii\web\View */
/* @var $article */

$this->title = $article['title'];

?>
<h3 class="text-info"><?php echo $article['title']; ?></h3>
<p class="text-info">
    <small><?php echo \common\base\Navigation::getInstance()->getNameById($article['type']); ?></small>
    <small><?php echo \common\base\User::getInstance()->getNameById($article['userid']); ?></small>
    <small><?php echo $article['readcount'] ? $article['readcount'] : 0; ?></small>
    <small><?php echo date('Y-m-d', $article['ctime']); ?></small>
</p>
<div><?php echo $article['content']; ?></div>
