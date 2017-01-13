<?php
namespace frontend\controllers;

use frontend\modules\api\v1\resources\User;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\Events;
use common\models\SettingsForm;
use common\models\Mailer;
use common\models\Recipients;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $this->newEvent(login, true);
            return $this->redirect('profile');
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goBack();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {

                    $this->newEvent(register, true);
                    return $this->redirect('profile');
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    // my methods

    public function actionProfile()
    {

        $event = Events::find()->asArray()->where(['name' => Yii::$app->user->identity->username])->orderBy(['id' => SORT_DESC])->all();
        return $this->render("profile", compact('event'));
    }

    public function actionCalendar()
    {

        $c_id = SettingsForm::find()->asArray()->where(['username' => Yii::$app->user->identity->username])->limit(1)->one();
        return $this->render("calendar", ['url' => $c_id['calendar_id']]);
    }

    public function newEvent($value, $update = null)
    {
        if ($update) {
            $newevent = new Events();
            $newevent->name = Yii::$app->user->identity->username;
            switch ($value) {
                case register:
                    $newevent->text = "добро пожаловать в систему";
                    break;
                case login:
                    $newevent->text = "вошёл в систему";
                    break;
                case newlink:
                    $newevent->text = "установлена новая ссылка для google calendar";
                    break;
            }
            $newevent->date = time();
            $newevent->save();
        }
    }

    public function actionSettings()
    {
        $set = SettingsForm::find()->where(['username' => Yii::$app->user->identity->username])->limit(1)->one();

        $sett = new SettingsForm();

        if ($sett->load(Yii::$app->request->post())) {
            if ($sett->validate()) {

                $set->calendar_id = $sett->calendar_id;
                $set->save();

                $this->newEvent(newlink, true);
                Yii::$app->session->SetFlash('success', 'Вы установили новую ссылку для google calendar');
            }
        }
        return $this->render("settings", ['sett' => $sett]);
    }

    public function actionMailer()
    {
        /*
         * I understand that this method is not relevant for hard mailing.
         * For large mailings it is better to import e-mail into another table and call the script via cron.
         * set_time_limit(60); default - 3 letters per minute. Can also use unisender for better speed.
         */
        $mail = Mailer::find()->asArray()->where(['<=', 'date', time() + 86400])->limit(1)->one();
        $users = Recipients::find()->asArray()->limit(3)->all();

        foreach ($users as $user) {

            Yii::$app->mailer->compose()
                ->setFrom(Yii::$app->params['adminEmail'])
                ->setTo($user['email'])
                ->setSubject($mail['theme'])
                ->setTextBody($mail['text'])
                ->setHtmlBody($mail['html'])
                ->send();

            //anti spam
            sleep(rand(14, 18));
        }

        $users->delete;

        return true;
    }


}
