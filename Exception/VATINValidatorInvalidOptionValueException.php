<?php

namespace ricardonavarrom\VATINValidatorBundle\Exception;

use Exception;

class VATINValidatorInvalidOptionValueException extends \Exception
{
    private $option;

    private $value;


    public function __construct($option, $value, $message = '', $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->option = $option;
        $this->value = $value;
    }

    public function getOption()
    {
        return $this->option;
    }

    public function getValue()
    {
        return $this->value;
    }
}
