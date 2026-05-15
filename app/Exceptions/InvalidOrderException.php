<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class InvalidOrderException extends Exception
{

    private $orderId = 1;
    /**
     * Get the exception's context information.
     *
     * @return array<string, mixed>
     */
    public function context(): array
    {
        return ['order_id' => $this->orderId];
    }
}
