<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12.01.2017
 * Time: 20:29
 */

namespace frontend\controllers;


use yii\base\Controller;

class AppController extends Controller
{

    public function debug($arr)
    {
        echo '<pre>' . print_r($arr, true) . '</pre>';
    }

}