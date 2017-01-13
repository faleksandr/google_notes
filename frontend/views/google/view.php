<?php

foreach ($model as $mdl) {

    if ($mdl['visibility'] == 'onlyme') {
        if ($mdl['author_id'] == Yii::$app->user->identity->id) {
            include __DIR__ . '/list/notes.php';
        }
    }
    elseif ($mdl['visibility'] == 'all') {
            include __DIR__ . '/list/notes.php';
    }
    elseif ($mdl['visibility'] == 'admins') {
        if($mdl['visibility'] == $user['role'] ){
            include __DIR__ . '/list/notes.php';
        }
    }
    elseif ($mdl['visibility'] == 'moderators') {
        if($mdl['visibility'] == $user['role'] ){
            include __DIR__ . '/list/notes.php';
        }
    }

}