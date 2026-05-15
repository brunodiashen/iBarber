<?php

namespace App\Services\Contract;

interface LogContract
{

    /**
     * Log Context.
     *
     * @param int $entidade
     * @param int $tipoOperacao
     * @param string|null $mensagem
     * @param string|null $dado
     * @param string|null $erro
     * @return array
     */
    public function context(int $entidade, int $tipoOperacao, string|null $mensagem = null,string|null $dado = null,string|null $erro = null): array;

    /**
     * Log internal info.
     *
     * @param array $ctx
     * @return void
     */
    public function debug(array $ctx): void;

    /**
     * Log success operation.
     *
     * @param array $ctx
     * @return void
     */
    public function success(array $ctx): void;

    /**
     * Log danger operation.
     *
     * @param array $ctx
     * @return void
     */
    public function alert(array $ctx): void;

    /**
     * Log execution error.
     *
     * @param array $ctx
     * @return void
     */
    public function error(array $ctx): void;

    /**
     * Log critical errors.
     *
     * @param array $ctx
     * @return void
     */
    public function critical(array $ctx): void;
}
