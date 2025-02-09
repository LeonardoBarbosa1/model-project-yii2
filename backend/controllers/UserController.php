<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use backend\models\UserSearch;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => [
                            'index',
                            'create',
                            'update',
                            'view',
                            'delete',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => [$this, 'isAdmin'],
                    ],
                    [
                        'actions' => [
//                            'update-profile',
                            'profile',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => [$this, 'isProfile'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {
            $model->setPassword($model->password_user);

            if ($model->save()){
                Yii::$app->getSession()->addFlash('success', Yii::t('app', 'Atualizado com sucesso'));

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            if (!empty($model->password_user)) {
                if ($model->password_user == $model->confirm_password){
                    $model->setPassword($model->password_user);
                }else {
                    Yii::$app->getSession()->addFlash('error', Yii::t('app', 'As senhas não coincidem.'));
                }
            } else {
                $model->password_hash = $model->getOldAttribute('password_hash');
            }

            if ($model->save()){
                Yii::$app->getSession()->addFlash('success', Yii::t('app', 'Atualizado com sucesso'));

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionProfile($id)
    {
        /**
         * @var $user User
         */
        $user = Yii::$app->user->identity;

        $model = $this->findModel($id);

        $trasaction = Yii::$app->db->beginTransaction();

        if ($model->load(Yii::$app->request->post())) {
            if ($user->type == User::TYPE_COMMON) {
                $model->type = User::TYPE_COMMON;
            }

            if (!empty($model->password_user)) {
                if ($model->password_user == $model->confirm_password){
                    $model->setPassword($model->password_user);
                }else {
                    Yii::$app->getSession()->addFlash('error', Yii::t('app', 'As senhas não coincidem.'));
                }
            } else {
                $model->password_hash = $model->getOldAttribute('password_hash');
            }

            if ($model->save()) {
                $trasaction->commit();
                Yii::$app->getSession()->addFlash('success', Yii::t('app', 'Atualizado com sucesso'));

                return $this->redirect(['user/profile', 'id' => $model->id]);
            }

            Yii::$app->getSession()->addFlash('error', 'Ocorreu um erro ao salvar o usuário.');

            return $this->redirect(['user/profile', 'id' => $model->id]);

        }

        return $this->render('profile', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::find()->whereId($id)->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
