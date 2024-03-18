<?php

namespace app\services\entity\exception;

use Throwable;

class EntityLabelParamException extends \Exception
{

    public function __construct($code = 0, Throwable $previous = null)
    {
        $message = 'Передан пустой массив labels';
        parent::__construct($message, $code, $previous);
    }
}