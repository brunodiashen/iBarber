<?php

namespace App\Services;

use App\Services\Contract\LogContract;
use App\Repositories\Contract\LogContract as LogRepositoryContract;

final class LogService implements LogContract
{
    public function __construct(
        private LogRepositoryContract $repository
    )
    {
    }

    public $tipoOperacaoLog = [
        'get' => 1,
        'store' => 2,
        'update' => 3,
        'delete' => 4
    ];

    public $entidades = [
        'cliente' => 1,
        'barbeiro' => 2,
        'horario' => 3,
        'endereco' => 4,
        'auth' => 5
    ];

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
    public function context(int $entidade, 
        int $tipoOperacao, 
        string|null $mensagem = null,
        string|null $dado = null,
        string|null $erro = null): array {
        return [
            'rota' => request()->fullUrl(),
            'tipo_operacao_log_id' => $tipoOperacao,
            'entidade_log_id' => $entidade,
            'mensagem' => $mensagem,
            'request' => $dado ?? json_encode(request()->all()),
            'erro' => $erro,
        ];
    }

    /**
     * Log internal info.
     *
     * @param array $ctx
     * @return void
     */
    public function debug(array $ctx): void {
        $ctx['codigo'] = 100;
        if (!$ctx['mensagem']) {
            $ctx['mensagem'] = 'Debugando';
        }
        // Log::debug('Debugando', $ctx);
        $this->repository->save($ctx);
    }

    /**
     * Log success operation.
     *
     * @param array $ctx
     * @return void
     */
    public function success(array $ctx): void {
        $ctx['codigo'] = 200;
        if (!$ctx['mensagem']) {
            $ctx['mensagem'] = 'Operacao realizada com sucesso.';
        }
        // Log::info('Operacao realizada com sucesso', $ctx);
        $this->repository->save($ctx);
    }

    /**
     * Log danger operation.
     *
     * @param array $ctx
     * @return void
     */
    public function alert(array $ctx): void {
        $ctx['codigo'] = 300;
        if (!$ctx['mensagem']) {
            $ctx['mensagem'] = 'Operacao realizada com alerta';
        }
        // Log::alert('Operacao realizada com alerta', $ctx);
        $this->repository->save($ctx);
    }

    /**
     * Log execution error.
     *
     * @param array $ctx
     * @return void
     */
    public function error(array $ctx): void {
        $ctx['codigo'] = 400;
        if (!$ctx['mensagem']) {
            $ctx['mensagem'] = 'Operacao nao realizada, ocorreu um erro';
        }
        // Log::error('Operacao nao realizada, ocorreu um erro', $ctx);
        $this->repository->save($ctx);
    }

    /**
     * Log critical errors.
     *
     * @param array $ctx
     * @return void
     */
    public function critical(array $ctx): void {
        $ctx['codigo'] = 500;
        if (!$ctx['mensagem']) {
            $ctx['mensagem'] = 'Ocorreu um erro critico';
        }
        // Log::critical('Ocorreu um erro critico', $ctx);
        $this->repository->save($ctx);
    }
}