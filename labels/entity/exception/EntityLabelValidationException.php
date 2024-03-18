<?php

namespace app\services\entity\exception;

use Throwable;

class EntityLabelValidationException extends \Exception
{

    public function __construct(int $entityId, string $entityLabel, array $errors, $code = 0, Throwable $previous = null)
    {
        $errorList = implode(',', $errors);
        $message = 'Ошибка валидации label - ' . $entityLabel . ' для сущности с id= ' . $entityId . '. ' . $errorList;
        parent::__construct($message, $code, $previous);
    }
}