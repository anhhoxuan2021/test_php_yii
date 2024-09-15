<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\RegisterForm;


class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
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
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'oAuthSuccess'],
            ],
        ];
    }

    public function oAuthSuccess($client) {
        // get user data from client
        $userAttributes = $client->getUserAttributes();
        echo '<pre>';
        var_dump($userAttributes);
        echo '</pre>';
        die();
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
       //print_r($_POST['LoginForm']); die();
       // if ($model->load(Yii::$app->request->post()) && $model->login()) {
        if ($model->load(Yii::$app->request->post())) {
            $username= $_POST['LoginForm']['userName'];
            $pass= $_POST['LoginForm']['password1'];
            $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('user')
                ->where(['username' => $username,
                'password_hash'=>$pass])
                ->limit(1)
                ->all();
            if(count($rows) > 0){
                $this->redirect(array('site/show_records'));
            }

           // return $this->goBack(['']);
        }

        $model->password1 = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionRegister()
    {
        $model = new RegisterForm();
        // print_r($_POST['LoginForm']); die();
        // if ($model->load(Yii::$app->request->post()) && $model->login()) {
        if ($model->load(Yii::$app->request->post()) && $model->createNewUser()) {
            //return $this->goBack(['']);
            $this->redirect(array('site/login'));
        }

        $model->password = '';
        return $this->render('register', [
            'model' => $model,
        ]);
    }

    public function actionShow_records()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,'https://api.nasa.gov/neo/rest/v1/feed?start_date=2015-09-07&end_date=2015-09-08&api_key=DEMO_KEY');
        curl_setopt($ch, CURLOPT_HTTPGET,1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $rsl=curl_exec ($ch);
        curl_close ($ch);

        $data_arr = json_decode($rsl,true);
        return $this->render('show_records', [
            'data_arr' => $data_arr['near_earth_objects']['2015-09-08'],
        ]);
    }
}
