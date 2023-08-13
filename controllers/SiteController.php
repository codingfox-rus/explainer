<?php

namespace app\controllers;

use app\dto\ExplainDTO;
use app\models\ContactForm;
use app\models\LoginForm;
use app\components\Parser;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

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
        ];
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
    
    public function actionParse()
    {
        $query = Yii::$app->request->post('query');
        /** @var Parser */
        $parser = Yii::$app->parser;
        
        $explainData = [];
        
        Yii::$app->db->createCommand('set profiling = 1')->execute();
        
        $rawData = Yii::$app->db
            ->createCommand('explain select * from actor')
            ->queryAll();
        
        $statData = Yii::$app->db->createCommand('show profiles')->queryOne();
        $duration = $statData['Duration'];
        
        Yii::$app->db->createCommand('set profiling = 0')->execute();
        
        foreach ($rawData as $row) {
            $explainData[] = new ExplainDTO($row);
        }
        
        $response['stat'] = $duration;
        $response['html'] = $this->renderPartial(
            '../_partials/explain',
            ['explainData' => $explainData]
        );
        
        $this->response->format = Response::FORMAT_JSON;
        
        return $response;
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
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
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
}
