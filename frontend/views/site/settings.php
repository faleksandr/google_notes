<?php
$this->title = 'Настройки';

use yii\widgets\ActiveForm;
use yii\helpers\Html;

if (Yii::$app->session->getFlash('success')) { ?>
    <div class="success_info">
        <div><?= Yii::$app->session->getFlash('success'); ?></div>
    </div>
<? } ?>

<div class="link_info">

    Пример ссылки:
    https://calendar.google.com/calendar/embed?src=80cr13idvbhc2hfv2b2e2hfi7s%40group.calendar.google.com&ctz=Europe/Kiev
</div>

<?php $form = ActiveForm::begin();
echo $form->field($sett, 'calendar_id')->textInput(['style' => 'width:400px;', 'placeholder' => 'Ссылка на ваш календарь']);
echo Html::submitButton('Сохранить', ['class' => 'btn btn-success', 'style' => 'width:100px;']);
ActiveForm::end(); ?>

