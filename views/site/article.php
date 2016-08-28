<?php
// 文章列表

use yii\helpers\Url;

/* @var $articles */
/* @var $pages */

?>
<?php foreach ($articles as $value): ?>
    <div class="center-block article">
        <!-- 标题(最长28个汉字,超过显示省略号)和概要 -->
        <div class="col-lg-12 col-md-12 col-xs-12">
            <h4>
                <a href="<?php echo Url::to(['index', 'id' => $value['id'], 'type' => $value['type']]); ?>" target="_blank">
                    <?php
                        $title = '';
                        if (mb_strlen($value['title'], 'utf-8') > 28) {
                            $title = mb_substr($value['title'], 0, 28, 'utf-8');
                        }
                        echo $title ? $title . '...' : $value['title'];
                    ?>
                </a>
            </h4>
            <p class="min-height">
                <small><?php echo \common\base\Navigation::getInstance()->getNameById($value['type']); ?></small>
                <small><?php echo \common\base\User::getInstance()->getNameById($value['userid']); ?></small>
                <small><?php echo $value['readcount'] ? $value['readcount'] : 0; ?></small>
                <small><?php echo date('Y-m-d H:i', $value['ctime']); ?></small>
            </p>
        </div>
    </div>
    <p></p>
<?php endforeach; ?>
<?php echo $pages; ?>
