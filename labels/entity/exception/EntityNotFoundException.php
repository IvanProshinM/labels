<?php

namespace app\services\entity\exception;

use Throwable;

class EntityNotFoundException extends \Exception
{

    public function __construct(int $entityId, $code = 0, Throwable $previous = null)
    {
        $message = 'Не найдена сущность с id= ' . $entityId;
        parent::__construct($message, $code, $previous);
    }
}