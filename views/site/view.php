<?php

/* @var $this \yii\web\View */
/* @var $article */

$this->title = $article['title'];

?>
<h4><?php echo $article['title']; ?></h4>
<p>
    <small><?php echo \common\base\Navigation::getInstance()->getNameById($article['type']); ?></small>
    <small><?php echo \common\base\User::getInstance()->getNameById($article['userid']); ?></small>
    <small><?php echo $article['readcount'] ? $article['readcount'] : 0; ?></small>
    <small><?php echo date('Y-m-d H:i', $article['ctime']); ?></small>
</p>
<div><?php echo $article['content']; ?></div>
