<?php

namespace app\services\entity\exception;

use Throwable;

class LabelNotFoundException extends \Exception
{

    public function __construct(string $labelName, $code = 0, Throwable $previous = null)
    {
        $message = 'Не найден label с таким названием: ' . $labelName;
        parent::__construct($message, $code, $previous);
    }
}