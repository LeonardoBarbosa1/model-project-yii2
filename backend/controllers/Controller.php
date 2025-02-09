<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller as ControllerBase;

class Controller extends ControllerBase
{

    /**
     * @return bool
     */
    public function isAdmin()
    {
        $user = Yii::$app->user->identity;
        if ($user->isAdmin) {
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function isProfile()
    {
        $requestedUserId = Yii::$app->request->get('id');
        $loggedInUserId = Yii::$app->user->id;

        // Verifica se o ID do usuário requisitado é o mesmo do usuário logado
        if ($requestedUserId == $loggedInUserId) {
            return true;
        }
        return false;
    }
}