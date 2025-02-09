<?php

use common\helpers\URLHelper;
use common\models\User;
use hail812\adminlte\widgets\Menu;
use yii\helpers\Url;

$usersCount = User::find()->count();

$user = Yii::$app->user->identity;

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= Url::home() ?>" class="brand-link">
        <span class="brand-text font-weight-light"><?= Yii::$app->name ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo Menu::widget([
                'items' => [
                    [
                        'label' => 'Dashboard',
                        'icon' => 'fas fa-home',
                        'url' => ['/'],
                        'active' => URLHelper::isRoute(['/']),
                    ],
                    ['label' => 'Perfil', 'header' => true],
                    [
                        'label' => $user->name,
                        'icon' => 'fas fa-user',
                        'url' => ['user/profile', 'id' => $user->id],
                    ],
                    [
                        'label' => 'Usuários',
                        'icon' => 'users',
                        'url' => ['user/index'],
                        'badge' => '<span class="right badge badge-info">' . $usersCount . '</span>',
                        'visible' => $user->isAdmin
                    ],
                    [
                        'label' => 'Yii2 PROVIDED',
                        'header' => true,
                        'visible' => YII_ENV_DEV,
                    ],
                    [
                        'label' => 'Gii',
                        'icon' => 'file-code',
                        'visible' => YII_ENV_DEV,
                        'url' => ['/gii'], 'target' => '_blank'],
                    [
                        'label' => 'Debug',
                        'icon' => 'bug',
                        'visible' => YII_ENV_DEV,
                        'url' => ['/debug'],
                        'target' => '_blank',
                    ],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>