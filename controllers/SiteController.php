<?php

namespace frontend\controllers;

use Yii;

class SiteController extends Base
{
    /**
     * 首页
     * @return mixed
     */
    public function actionIndex()
    {
        // 首页文章列表,不做缓存
        $type = isset($_GET['type']) && intval($_GET['type']) ? intval($_GET['type']) : 1;

        $total = 0;
        $pages = '';
        // 是否有文章ID存在
        if (isset($_GET['id']) && intval($_GET['id'])) {
            $articleId = intval($_GET['id']);
            $article = \common\base\Article::getInstance()->getById($articleId);
            if ($article) {
                $articles[] = $article;
                // 需要统计阅读次数
                \common\models\Article::updateAllCounters(['readcount' => 1], ' `id` = :id', [
                    ':id' => $articleId,
                ]);
            } else {
                // 如果信息有误,清除参数,直接跳转
                unset($_GET['id'], $_GET['type']);
                return $this->redirect(['index']);
            }
        } else {
            $query = \common\models\Article::find();
            $query->where(' `status` != :status', [
                ':status' => \common\base\Status::Delete,
            ]);
            $query->andWhere(' `type` = :type', [
                ':type' => $type,
            ]);
            $total = $query->count();
            $pageSize = 10;
            $pager = new \common\base\Page();
            $pager->pageName = 'page';
            $pages = $pager->show($total, $pageSize);
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $offset = $pageSize * ($page - 1);
            if ($offset >= $total) {
                $offset = $total;
            };
            $query->offset($offset);
            $query->limit($pageSize);
            $query->orderBy(' `id` DESC');
            $articles = $query->asArray()->all();
        }
        // 每日一语
        $sentence = \common\base\Sentence::getInstance()->getSentence();
        // 推荐阅读(技术类)
        $techniques = \common\base\Recommend::getInstance()->getList(1);
        // 推荐阅读(普通类)
        $generals = \common\base\Recommend::getInstance()->getList(2);
        // 友情链接
        $links = \common\base\Link::getInstance()->getList();

        return $this->render('index', [
            'total' => $total, 'pages' => $pages, 'articles' => $articles, 'sentence' => $sentence,
            'techniques' => $techniques, 'generals' => $generals, 'links' => $links,
        ]);
    }

    /**
     * 登陆
     * @return mixed
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionLogin()
    {
        throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
//        if (!\Yii::$app->getUser()->getIsGuest()) {
//            return $this->goHome();
//        }
//        $model = new \common\models\LoginForm();
//        if ($model->load(Yii::$app->getRequest()->post()) && $model->login()) {
//            return $this->goBack();
//        } else {
//            return $this->render('login', ['model' => $model]);
//        }
    }

    /**
     * 退出
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->getUser()->logout();
        return $this->goHome();
    }

    /**
     * 注册
     * @return mixed
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionSignup()
    {
        throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
//        $model = new \frontend\models\SignupForm();
//        if ($model->load(Yii::$app->getRequest()->post())) {
//            if ($user = $model->signup()) {
//                if (Yii::$app->getUser()->login($user)) {
//                    return $this->goHome();
//                }
//            }
//        }
//        return $this->render('signup', ['model' => $model]);
    }
}
