<?php

namespace frontend\controllers;

//use frontend\modules\api\v1\resources\User;
use common\models\User;
use Yii;
use common\models\Notes;
use common\models\Category;
use common\models\CatList;
use common\models\EditForm;
use common\models\Search;
use common\models\Roles;

class GoogleController extends AppController
{
    public $data;
    public $tree;
    public $buffer;

    /*
     * Form for add new notes
     */

    public function actionIndex()
    {

        $this->data = Category::find()->indexBy('id')->asArray()->all();
        $this->tree = $this->getTree();

        $model = new Notes();
        $rbac = Roles::find()->asArray()->all();
        //$this->debug($rbac);

        if ($model->load(Yii::$app->request->post())) {

            $model->author = Yii::$app->user->identity->username;
            $model->author_id = Yii::$app->user->identity->id;
            $model->date = time();
            $model->save();

            $category_list = new CatList();
            $category_list->notes_id = $model->id;
            $category_list->category_id = $model->cat;
            $category_list->insert();
            Yii::$app->session->SetFlash('success', 'Success');
        }

        return $this->render('index', ['model' => $model, 'tree' => $this->getList($this->tree), 'rbac' => $rbac]);
    }

    protected function getTree()
    {
        foreach ($this->data as $id => &$node) {
            if (!$node['parent_id'])
                $tree[$id] = &$node;
            else
                $this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
        }
        return $tree;
    }

    protected function getList($tree)
    {
        foreach ($tree as $category) {
            $str .= $this->buffer($category);
        }
        return $str;
    }

    protected function buffer($category)
    {
        ob_start();
        include __DIR__ . '/categories/all.php';
        return ob_get_clean();
    }

    /*
     * View notes
     */

    public function actionView()
    {
        $model = Notes::find()->asArray()->all();
        $user = User::find()->asArray()->select(['role'])->where(['id' => Yii::$app->user->identity->id])->limit(1)->one();
       // $groups = Roles::find()->asArray()->indexBy('id')->all();
       // $rbac = Roles::find()->asArray()->select(['name'])->where(['id' => $user['role']])->limit(1)->one();


        //$this->debug($groups);
        return $this->render('view', ['model' => $model, 'user' => $user/*, 'rbac' => $rbac, 'groups' => $groups*/]);
    }

    /*
     * Editor for notes
     */

    public function actionEdit()
    {
        $model = Notes::find()->asArray()->orderBy(['id' => SORT_DESC])->all();
        $user = User::find()->asArray()->select(['role'])->where(['id' => Yii::$app->user->identity->id])->limit(1)->one();
        $request = Yii::$app->request;
        $id = $request->get('id');

        if ($id) {
            $edit_note = Notes::find()->where(['id' => $id])->limit(1)->one();
            $edit_open = new EditForm();

            if ($edit_open->load(Yii::$app->request->post())) {

                $edit_note->name = $edit_open->name;
                $edit_note->text = $edit_open->text;
                $edit_note->tags = $edit_open->tags;
                $edit_note->img = $edit_open->img;
                //$this->debug($edit_note);
                $edit_note->save();
            }
            return $this->render('editor', compact('model', 'edit_note', 'edit_open', 'user'));
        }

        if (!$id) return $this->render('edit', compact('model', 'user'));
    }

    /*
     * Search of a tags
     */

    public function actionSearch()
    {
        $find = new Search();
        if ($find->load(Yii::$app->request->post())) {
            $model = Notes::find()->asArray()->where(['like', 'tags', $find->search])->all();
            //$this->debug($find);
        } else $model = array();

        return $this->render('search', compact('model', 'find'));
    }

    public function actionGoogle()
    {

        $client_id = '517769358339-52va61f023oi447qtmol659rdeh2je58.apps.googleusercontent.com'; // Client ID
        $client_secret = 'XVJQjSZ9KkSq2SYcTopPn__c'; // Client secret
        $redirect_uri = 'https://alexfedorov.info'; // Redirect URI

        $url = 'https://accounts.google.com/o/oauth2/auth';

        $params = array(
            'redirect_uri' => $redirect_uri,
            'response_type' => 'code',
            'client_id' => $client_id,
            'scope' => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile'
        );

        $request = Yii::$app->request;
        $id = $request->get('id');

        if ($id) {
            $result = false;

            $params = array(
                'client_id' => $client_id,
                'client_secret' => $client_secret,
                'redirect_uri' => $redirect_uri,
                'grant_type' => 'authorization_code',
                'code' => $_GET['code']
            );

            $url = 'https://accounts.google.com/o/oauth2/token';
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($curl);
            curl_close($curl);

            $tokenInfo = json_decode($result, true);

            if (isset($tokenInfo['access_token'])) {
                $params['access_token'] = $tokenInfo['access_token'];

                $userInfo = json_decode(file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo' . '?' . urldecode(http_build_query($params))), true);
                if (isset($userInfo['id'])) {
                    $userInfo = $userInfo;
                    $result = true;
                }
            }

            if ($result) {
                echo 'Данные получены, пользователь авторизирован!';
                //$this->debug($result);
            }

        }

        $this->render('oauth', compact('url', 'params', 'client_secret'));

    }


}