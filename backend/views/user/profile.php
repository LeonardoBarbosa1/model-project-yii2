<?php

use common\models\User;
use kartik\detail\DetailView;
use kartik\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->name;
$this->params['breadcrumbs'][] = Yii::t('app', 'Perfil');
\yii\web\YiiAsset::register($this);
?>

<div class="container-fluid">
    <div class="card" style="border-radius: 20px">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
<!--                    <p>-->
<!--                        --><?php //= Html::a('Atualizar', ['update-profile', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
<!--                    </p>-->

                    <?= DetailView::widget([
                        'model' => $model,
                        'mode' => DetailView::MODE_VIEW,
                        'panel' => [
                            'heading' => 'Perfil',
                            'type' => DetailView::TYPE_DARK,
                        ],
                        'buttons1' => '{update}',
                        'updateOptions' => ['title' => 'Atualizar'],
                        'viewOptions' => ['title' => 'Visualizar'],
                        'resetOptions' => ['title' => 'Cancelar Alterações'],
                        'saveOptions' => ['title' => 'Salvar'],
                        'attributes' => [
                            'email:email',
//                            'username',
                             'name',
                            [
                                'attribute' => 'password_user',
                                'format' => 'raw',
                                'value' => '******',
                                'type' => DetailView::INPUT_PASSWORD,
                            ],
                            [
                                'attribute' => 'confirm_password',
                                'format' => 'raw',
                                'value' => '******',
                                'type' => DetailView::INPUT_PASSWORD,
                            ],
                            [
                                'attribute' => 'type',
                                'displayOnly' => true,
                                'value' => User::typeValues($model->type),
                            ],
                            [
                                'attribute' => 'created_at',
                                'displayOnly' => true,
                                'format' => 'date',
                            ],
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>