<?php

namespace hiqdev\yii2\errorNotifier\controllers;

use hiqdev\yii2\errorNotifier\actions\ErrorAction;
use hiqdev\yii2\errorNotifier\logic\DebugSessionSaver;
use hiqdev\yii2\errorNotifier\logic\FeedbackSender;
use hiqdev\yii2\errorNotifier\models\FeedbackForm;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;

class ErrorController extends Controller
{
    public function actions()
    {
        return [
            'index' => ErrorAction::class
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => VerbFilter::class,
                'actions' => [
                    'send' => ['post'],
                ]
            ]
        ];
    }

    public function actionSend()
    {
        $form = new FeedbackForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            /** @var FeedbackSender $sender */
            Yii::createObject(DebugSessionSaver::class, [$form->session_tag])->run();
            $sender = Yii::createObject(FeedbackSender::class, [$form]);

            return $this->render('sent', [
                'model' => $form,
                'success' => $sender->send()
            ]);
        }

        return $this->redirect(Yii::$app->getHomeUrl());
    }
}
