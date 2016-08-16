<?php

namespace frontend\controllers;

use yii\web\Controller;

class Base extends Controller
{
    public function init()
    {
        parent::init();
        //记录请求详细日志
        $requestLog = [
            'IP]' . \Yii::$app->getRequest()->getUserIP(),
            'Method]' . \Yii::$app->getRequest()->getMethod(),
            'UserHost]' . \Yii::$app->getRequest()->getUserHost(),
            'UserAgent]' . \Yii::$app->getRequest()->getUserAgent(),
            'HostInfo]' . \Yii::$app->getRequest()->getHostInfo(),
            'ReqUri]' . strtolower(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $_SERVER['DOCUMENT_URI']),
            'Get]' . \yii\helpers\Json::encode($_GET),
            'Post]' . \yii\helpers\Json::encode($_POST),
            'rawBody]' . \Yii::$app->getRequest()->getRawBody(),
        ];
        \common\base\TaskLog::getInstance()->writeLog($requestLog);
    }

    /**
     * 错误页面
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
}
