<?php

namespace hiqdev\yii2\errorNotifier\models;

use Yii;
use yii\base\Model;

class FeedbackForm extends Model
{
    /**
     * @var string
     */
    public $message;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $session_tag;

    public function attributes()
    {
        return ['message', 'email', 'session_tag'];
    }

    public function attributeLabels()
    {
        return [
            'message' => Yii::t('error-notifier', 'Message'),
        ];
    }

    public function rules()
    {
        return [
            [['message'], 'required'],
            [['email'], 'safe', 'when' => Yii::$app->user->isGuest],
            [['session_tag'], 'safe'],
        ];
    }
}
