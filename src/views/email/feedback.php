<?php

/**
 * @var \yii\web\View
 * @var \hiqdev\yii2\errorNotifier\models\FeedbackForm $form
 */
?>

<?= Yii::t('error-notifier', 'User have submitted a report in response to an error.') ?>
<br />
<?php if (Yii::$app->user->isGuest) : ?>
    <?= Yii::t('error-notifier', 'Contact email: {email}', ['email' => (string) $form->email]) ?>
<?php elseif (!empty(Yii::$app->user->identity->username)): ?>
    <?= Yii::t('error-notifier', 'Username: {username}', ['username' => Yii::$app->user->identity->username]) ?>
<?php endif ?>
<br />
<?php if ($form->session_tag) : ?>
    <?= Yii::t('error-notifier', 'Related debug session tag: {tag}', ['tag' => $form->session_tag]) ?>
<?php endif ?>

<br />


<br />
<br />

<?= $form->message ?>
