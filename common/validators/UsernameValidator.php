<?php

namespace common\validators;

use Yii;
use yii\validators\RegularExpressionValidator;

class UsernameValidator extends RegularExpressionValidator
{

    public $pattern = '/^[a-z][a-z0-9_.]{2,30}$/';

}