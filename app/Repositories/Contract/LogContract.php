<?php

namespace App\Repositories\Contract;

interface LogContract
{
    
    /**
     * Save log into database.
     *
     * @param array $ctx
     * @return void
     */
    public function save(array $ctx): void;
    
}
