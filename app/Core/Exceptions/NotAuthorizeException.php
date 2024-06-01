<?php

namespace App\Core\Exceptions;

use Throwable;

class NotAuthorizeException extends \Exception
{
    /**
     * __construct
     *
     * @param string $message
     * @return void
     */
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
