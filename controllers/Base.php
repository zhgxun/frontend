<?php

namespace frontend\controllers;

use yii\web\Controller;

class Base extends Controller
{
    public function init()
    {
        parent::init();
        //记录请求详细日志
        $ip = \Yii::$app->getRequest()->getUserIP();
        $method = \Yii::$app->getRequest()->getMethod();
        $userHost = \Yii::$app->getRequest()->getUserHost();
        $userAgent = \Yii::$app->getRequest()->getUserAgent();
        $hostInfo = \Yii::$app->getRequest()->getHostInfo();
        $requestUri = strtolower(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $_SERVER['DOCUMENT_URI']);
        $get = \yii\helpers\Json::encode($_GET);
        $post = \yii\helpers\Json::encode($_POST);
        $rawBody = \Yii::$app->getRequest()->getRawBody();
        $requestUserId = \Yii::$app->getUser()->getId() ? : 0;

        // 该部分日志记录到文件中
        $requestLog = [
            'IP]' . $ip,
            'Method]' . $method,
            'UserHost]' . $userHost,
            'UserAgent]' . $userAgent,
            'HostInfo]' . $hostInfo,
            'ReqUri]' . $requestUri,
            'Get]' . $get,
            'Post]' . $post,
            'rawBody]' . $rawBody,
            'RequestUserID]' . $requestUserId,
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
