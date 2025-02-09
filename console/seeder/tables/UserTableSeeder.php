<?php

namespace console\seeder\tables;

use antonyz89\seeder\helpers\CreatedAtUpdatedAt;
use common\models\User;
use console\seeder\DatabaseSeeder;
use console\seeder\TableSeeder;
use Yii;

class UserTableSeeder extends TableSeeder
{


    function run()
    {
        loop(function($i) {
            $this->insert(User::tableName(), [
                'email' => "user{$i}@modelproject.com",
                'username' => "user{$i}",
                'name' => "User {$i}",
                'type' => User::TYPE_COMMON,
                'auth_key' => Yii::$app->security->generateRandomString(),
                'password_hash' => Yii::$app->security->generatePasswordHash('user'),
            ]);

            $this->insert(User::tableName(), [
                'email' => "admin{$i}@modelproject.com",
                'username' => "admin{$i}",
                'name' => "Admin {$i}",
                'type' => User::TYPE_ADMIN,
                'auth_key' => Yii::$app->security->generateRandomString(),
                'password_hash' => Yii::$app->security->generatePasswordHash('admin'),
            ]);
        }, DatabaseSeeder::USER_COUNT);
    }
}