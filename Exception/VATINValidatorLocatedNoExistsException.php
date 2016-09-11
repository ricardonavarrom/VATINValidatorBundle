<?php

namespace ricardonavarrom\VATINValidatorBundle\Exception;

use Exception;

class VATINValidatorLocatedNoExistsException extends \Exception
{
    private $locale;

    public function __construct($locale, $message = '', $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->locale = $locale;
    }
}