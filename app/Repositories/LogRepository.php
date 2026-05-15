<?php

namespace App\Repositories;

use App\Models\Logs;
use App\Repositories\Contract\LogContract;

final class LogRepository implements LogContract
{
    public function __construct(private Logs $model)
    {
        
    }

    /**
     * Save log into database.
     *
     * @param array $ctx
     * @return void
     */
    public function save(array $ctx): void {
        $this->model->create($ctx);
    }
}