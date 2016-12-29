<?php

namespace hiqdev\yii2\errorNotifier\actions;

use hiqdev\yii2\errorNotifier\models\FeedbackForm;
use Yii;

class ErrorAction extends base\ErrorAction
{
    protected function getViewRenderParams()
    {
        return array_merge(parent::getViewRenderParams(), [
            'model' => $this->buildFeedbackForm()
        ]);
    }

    private function buildFeedbackForm()
    {
        $model = new FeedbackForm();

        if (Yii::$app->hasModule('debug')) {
            /** @var \yii\debug\Module $debug */
            $debug = Yii::$app->getModule('debug');
            $model->session_tag = $debug->logTarget->tag;
        }

        return $model;
    }
}
