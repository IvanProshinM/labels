<?php

namespace app\services\entity\exception;

use Throwable;

class EntityLabelNotFoundException extends \Exception
{

    public function __construct(int $entityId, string $entityLabel, $code = 0, Throwable $previous = null)
    {
        $message = 'Не найден label - ' . $entityLabel . ' для сущности с id= ' . $entityId;
        parent::__construct($message, $code, $previous);
    }
}