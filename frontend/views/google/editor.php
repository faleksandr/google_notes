<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

//\frontend\controllers\AppController::debug($edit_note);

$form = ActiveForm::begin();
echo $form->field($edit_open, 'name')->textInput(['style' => 'width:400px;', 'value' => $edit_note['name']]);
echo $form->field($edit_open, 'text')->textarea(['style' => 'width:400px;', 'rows' => 5, 'value' => $edit_note['text']]);
echo $form->field($edit_open, 'tags')->textInput(['style' => 'width:400px;', 'value' => $edit_note['tags']]);
echo $form->field($edit_open, 'img')->textInput(['style' => 'width:400px;', 'value' => $edit_note['img']]);
echo Html::submitButton('Изменить', ['class' => 'btn btn-success', 'style' => 'width:100px;']);
ActiveForm::end();