<?php

/*
 * 1,2,3 and more for roles
 * 100 - only for me
 * 101 - all
 * type column tinyint(255) from -127 to 127 :)
 */

$role = Yii::$app->user->identity->role;

foreach ($model as $mdl) {

    if ($mdl['visibility'] == 100) {
        if ($mdl['author_id'] == Yii::$app->user->identity->id) include __DIR__ . '/list/notes.php';
    } elseif ($mdl['visibility'] == 101) {
        include __DIR__ . '/list/notes.php';
    } elseif ($mdl['visibility'] == $role) {
        include __DIR__ . '/list/notes.php';
    } elseif ($mdl['visibility'] == $role) {
        include __DIR__ . '/list/notes.php';
    } elseif ($mdl['visibility'] == $role) {
        include __DIR__ . '/list/notes.php';
    } elseif ($mdl['visibility'] == $role) {
        include __DIR__ . '/list/notes.php';
    }

}