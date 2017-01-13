<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$role = $user['role'];
if ($role == 1) {
    foreach ($model as $mdl) { ?>
        <table class="table" style="margin-top: 20px;">
            <tr>
                <td style="width: 20%;"><?= $mdl['name']; ?></td>
                <td><?= $mdl['text']; ?></td>
                <td><?= $mdl['img']; ?></td>
                <td><?= date("d.m.Y : H:i", $mdl['date']); ?></td>
                <td>
                    <a href="/google/edit?id=<? echo $mdl['id']; ?>" class="btn btn-link">Изменить</a>
                </td>
            </tr>
        </table>
        <?
    }
}