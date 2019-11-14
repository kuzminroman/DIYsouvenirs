<?php
namespace common\modules\wishlist\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\modules\wishlist\models\Wishlist;
use yii\helpers\Url;
use yii\db\Expression;

/**
 * Default controller for the `wishlist` module
 */
class ElementController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'add' => ['post'],
                    'remove' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;

        return parent::beforeAction($action);
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Добавить в избранное
     * @return [type] [description]
     */
    public function actionAdd()
    {
        $wishlistModel = new Wishlist();

        $postData = \Yii::$app->request->post();

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if(Yii::$app->user->isGuest)
        {
            $uwlToken = Yii::$app->request->cookies->getValue('uwl_token', null);

            // небольшая проверка на случай если уже добавлен из модального окна или на другой вкладке
            $checkModel = Wishlist::find()->where([
                'token' => $uwlToken,
                'model' => $postData['model'],
                'item_id' => $postData['itemId'],
                'type_wish' => isset($postData['type_wish'])?$postData['type_wish']: 0 ,
                ])->one();

            if ($checkModel) {
                return [
                    'response' => true,
                    'url' => Url::toRoute('/wishlist/element/remove'),
                ];
            }
        }
        else
        {
            // небольшая проверка на случай если уже добавлен из модального окна или на другой вкладке
            $checkModel = Wishlist::find()->where([
                'user_id' => \Yii::$app->user->getId(),
                'model' => $postData['model'],
                'item_id' => $postData['itemId'],
                'type_wish' => isset($postData['type_wish'])?$postData['type_wish']: 0 ,
                ])->one();

            if ($checkModel) {
                return [
                    'response' => true,
                    'url' => Url::toRoute('/wishlist/element/remove'),
                    'type_wish' => isset($postData['type_wish'])?$postData['type_wish']: 0 ,
                ];
            }
        }


        if(Yii::$app->user->isGuest)
        {
            $uwlToken = Yii::$app->request->cookies->getValue('uwl_token', null);
            /**
             * Если токен не найден, сохранить в куки новый токен
             * @var [type]
             */
            if($uwlToken === null)
            {
                $uwlToken = \Yii::$app->security->generateRandomString();
                Yii::$app->response->cookies->add(new \yii\web\Cookie([
                    'name' => 'uwl_token',
                    'value' => $uwlToken,
                    'expire' => time()+\Yii::$app->getModule('wishlist')->cokieDateExpired,
                ]));
            }
            $wishlistModel->token = $uwlToken;
            $wishlistModel->action = 'remove';
            $wishlistModel->token_expire = new Expression(\Yii::$app->getModule('wishlist')->dbDateExpired);
        }
        else
        {
            $uwlToken = Yii::$app->request->cookies->getValue('uwl_token', null);
            /**
             * Если токен не найден, сохранить в куки новый токен
             * @var [type]
             */
            if($uwlToken === null)
            {
                Yii::$app->response->cookies->add(new \yii\web\Cookie([
                    'name' => 'uwl_token',
                    'value' => \Yii::$app->security->generateRandomString(),
                    'expire' => time()+\Yii::$app->getModule('wishlist')->cokieDateExpired,
                ]));
            }

            $wishlistModel->token = $uwlToken;
            $wishlistModel->token_expire = new Expression(\Yii::$app->getModule('wishlist')->dbDateExpired);
            $wishlistModel->user_id = \Yii::$app->user->id;
            $wishlistModel->action = 'remove';

        }


        $wishlistModel->model = $postData['model'];
        $wishlistModel->item_id = $postData['itemId'];
        $wishlistModel->type_wish = isset($postData['type_wish'])?$postData['type_wish']: 0;
        $wishlistModel->action = 'remove';





        if ($wishlistModel->save()) {
            return [
                'count' => Wishlist::find()->where(['user_id' => \Yii::$app->user->id,])->count(),
                'response' => true,
                'url' => Url::toRoute('/wishlist/element/remove'),
            ];
        }
        else {
            return [
                'count' => Wishlist::find()->where(['user_id' => \Yii::$app->user->id,])->count(),
                'response' => $wishlistModel->getErrors(),
                'url' => Url::toRoute('/wishlist/element/remove'),
            ];
        }

        return [
            'response' => false
        ];

    }

    /**
     * Удалить из избранного
     * @return [type] [description]
     */
    public function actionRemove()
    {
        $postData = \Yii::$app->request->post();

        if(Yii::$app->user->isGuest)
        {
            $uwlToken = Yii::$app->request->cookies->getValue('uwl_token', null);
            $elementModel = Wishlist::find()->where([
                'token' => $uwlToken,
                'model' => $postData['model'],
                'item_id' => $postData['itemId'],
                'type_wish' => isset($postData['type_wish'])?$postData['type_wish']: 0 ,
                ])->one();
        }
        else
        {
            $elementModel = Wishlist::find()->where([
                'user_id' => \Yii::$app->user->id,
                'model' => $postData['model'],
                'item_id' => $postData['itemId'],
                'type_wish' => isset($postData['type_wish'])?$postData['type_wish']: 0 ,
                ])->one();
        }



        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        // небольшая проверка на случай если уже удалено из модального окна или на другой вкладке
        if ($elementModel)
        {
            if ($elementModel->delete()) {
                return [
                    'count' => Wishlist::find()->where(['user_id' => \Yii::$app->user->id,])->count(),
                    'response' => true,
                    'url' => Url::toRoute('/wishlist/element/add'),
                    'type_wish' => isset($postData['type_wish'])?$postData['type_wish']: 0 ,
                ];
            }
        }
        else
        {
            return [
                'count' => Wishlist::find()->where(['user_id' => \Yii::$app->user->id,])->count(),
                'response' => true,
                'url' => Url::toRoute('/wishlist/element/add'),
                'type_wish' => isset($postData['type_wish'])?$postData['type_wish']: 0 ,
            ];
        }

        return [
            'response' => false
        ];
    }

}
