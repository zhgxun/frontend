<?php

/* @var $this yii\web\View */
/* @var $total */
/* @var $pages */
/* @var $articles */
/* @var $sentence */
/* @var $techniques */
/* @var $generals */
/* @var $links */

$this->title = '小步';

$this->registerCss('
    .article {
        min-height : 80px;
    }
');
?>
<div class="site-index">
    <div class="row">
        <!-- 文章列表区域 -->
        <div class="col-lg-8 col-md-8 col-xs-12">
            <?php
                \yii\widgets\Pjax::begin();
                $template = 'article';
                if (count($articles) <= 1 && isset($_GET['id']) && intval($_GET['id'])) {
                    $template = 'view';
                    $articles = $articles[0];
                }
                echo $this->render($template, ['articles' => $articles, 'pages' => $pages]);
                \yii\widgets\Pjax::end();
            ?>
        </div>

        <!-- 右边框内容区域 -->
        <div class="col-lg-4 col-md-4 col-xs-12">
            <!-- 每日一语 -->
            <?php if ($sentence) { ?>
                <div class="sentence">
                    <blockquote>
                        <p class="text-primary"><?php echo $sentence['title']; ?></p>
                        <footer><?php echo $sentence['author']; ?> <cite title="Source Title"><?php echo $sentence['quote']; ?></cite></footer>
                    </blockquote>
                </div>
            <?php } ?>

            <!-- 推荐阅读(技术类) -->
            <?php if ($techniques) { ?>
                <div class="read-technology">
                    <h5>推荐阅读(技术)</h5>
                    <ol>
                        <?php foreach ($techniques as $technique): ?>
                            <li>
                                <a href="<?php echo $technique['url']; ?>" target="_blank">
                                    <?php echo $technique['title']; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ol>
                </div>
            <?php } ?>

            <!-- 推荐阅读(非技术类) -->
            <?php if ($generals) { ?>
                <div class="read-feelings">
                    <h5>推荐阅读(普通)</h5>
                    <ol>
                        <?php foreach ($generals as $general): ?>
                            <li>
                                <a href="<?php echo $general['url']; ?>" target="_blank">
                                    <?php echo $general['title']; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ol>
                </div>
            <?php } ?>

            <!-- 友情链接 -->
            <?php if ($links) { ?>
                <div class="link">
                    <h5>友情链接</h5>
                    <ul class="list-inline">
                    <?php foreach ($links as $link): ?>
                        <li>
                            <a href="<?php echo $link['url']; ?>" target="_blank">
                                <?php echo $link['title']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
