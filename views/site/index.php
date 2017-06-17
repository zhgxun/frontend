<?php

/* @var $this yii\web\View */
/* @var $pages */
/* @var $articles */

$this->title = '小步';

use yii\helpers\Url;

?>
<div class="site-index">
    <div class="row">
        <?php foreach ($articles as $value): ?>
            <div class="center-block">
                <!-- 标题(最长28个汉字,超过显示省略号)和概要 -->
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <h3>
                        <a href="<?php echo Url::to(['view', 'id' => $value['id']]); ?>" rel="noopener">
                            <?php
                            $title = '';
                            if (mb_strlen($value['title'], 'utf-8') > 28) {
                                $title = mb_substr($value['title'], 0, 28, 'utf-8');
                            }
                            echo $title ? "{$title}..." : $value['title'];
                            ?>
                        </a>
                    </h3>
                    <p class="text-success">
                        <small><?php echo \common\base\Navigation::getInstance()->getNameById($value['type']); ?></small>
                        <small><?php echo \common\base\User::getInstance()->getNameById($value['userid']); ?></small>
                        <small><?php echo $value['readcount'] ? $value['readcount'] : 0; ?></small>
                        <small><?php echo date('Y-m-d', $value['ctime']); ?></small>
                    </p>

                    <p class="text-info">
                        <?php echo $value['summary']; ?>
                    </p>
                </div>
            </div>
            <p></p>
        <?php endforeach; ?>
        <?php echo $pages; ?>
    </div>
</div>
