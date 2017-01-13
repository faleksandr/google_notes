<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin();
echo $form->field($find, 'search')->textInput(['style' => 'width:400px;']);
echo Html::submitButton('Поиск', ['class' => 'btn btn-success', 'style' => 'width:100px;']);
ActiveForm::end();
