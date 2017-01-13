<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

    <div class="topmenu">
        <table>
            <tr>
                <td>
                    <a href="<?= Url::toRoute('/'); ?>"> Главная</a>
                </td>
                <td>
                    <? if (Yii::$app->user->isGuest) { ?>

                        <a href="<?= Url::toRoute('site/signup'); ?>"> Регистрация</a>
                        <a href="<?= Url::toRoute('site/login'); ?>"> Войти</a>

                    <? } else { ?>
                        <?= Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton('Выйти из аккаунта ' . Yii::$app->user->identity->username,
                            ['class' => 'btn-link logout fix']) . Html::endForm(); ?>
                    <? } ?>
                </td>
            </tr>
        </table>
    </div>

<div class="container">
    <div class="fixct">
        <? if (!Yii::$app->user->isGuest) { ?>
            <a class="profile_link" href="<?= Url::toRoute('/site/profile'); ?>"> Мой профиль</a>
            <a class="profile_link" href="<?= Url::toRoute('/site/calendar'); ?>"> Календарь</a>
            <a class="profile_link" href="<?= Url::toRoute('/site/settings'); ?>"> Настройки</a>

            <a class="profile_link" href="<?= Url::toRoute('/google'); ?>"> Notes</a>
            <a class="profile_link" href="<?= Url::toRoute('/google/view'); ?>"> View</a>
            <a class="profile_link" href="<?= Url::toRoute('/google/edit'); ?>"> Edit</a>
            <a class="profile_link" href="<?= Url::toRoute('/google/search'); ?>"> Search</a>
        <? } ?>
        <?= $content ?>
    </div>
</div>
</div>
<!--
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <? /*= date('Y') */ ?></p>

        <p class="pull-right"><? /*= Yii::powered() */ ?></p>
    </div>
</footer>-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
