<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<div style="margin-top: 50px;"></div>

<?php
$form = ActiveForm::begin();
echo $form->field($model, 'name')->textInput(['style' => 'width:400px;']);
echo $form->field($model, 'text')->textarea(['style' => 'width:400px;', 'rows' => 5]);
echo '<b>Выберите категорию</b><br>';
echo $tree;?>
<br><b>Видимость заметки</b><br>
<input type="radio" name="Notes[visibility]" value="100"> Только мне<br>
<input type="radio" name="Notes[visibility]" checked value="101"> Всем<br>
<?php
foreach ($rbac as $role){?>
    <input type="radio" name="Notes[visibility]" value="<?=$role['id'];?>"> Группе: <?=$role['name'];?>
    <br>
<?
}
echo $form->field($model, 'image')->fileInput();
echo $form->field($model, 'tags')->textInput(['style' => 'width:400px;']);
echo Html::submitButton('Сохранить', ['class' => 'btn btn-success', 'style' => 'width:100px;']);
ActiveForm::end();
?>

<div style="margin:50px;"></div>
