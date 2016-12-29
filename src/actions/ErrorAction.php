<?php
/**
 * Error Notifier for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-error-notifier
 * @package   yii2-error-notifier
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2016, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii2\errorNotifier\actions;

use hiqdev\yii2\errorNotifier\models\FeedbackForm;
use Yii;

class ErrorAction extends base\ErrorAction
{
    protected function getViewRenderParams()
    {
        return array_merge(parent::getViewRenderParams(), [
            'model' => $this->buildFeedbackForm(),
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
