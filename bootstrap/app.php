<?php

use App\Models\Logs;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\Http\Middleware\CheckAbilities;
use Laravel\Sanctum\Http\Middleware\CheckForAnyAbility;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->api(prepend: [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        ]);

        $middleware->alias([
            'verified' => \App\Http\Middleware\EnsureEmailIsVerified::class,
        ]);

        $middleware->alias([
            'abilities' => CheckAbilities::class,
            'ability' => CheckForAnyAbility::class,
        ]);

        $middleware->validateCsrfTokens(except: ['http://localhost/api/v1/*']);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Handling generic exceptions
        $exceptions->render(function (Exception $e, Request $request) {
            $logs = new Logs();
            // $logs->error($logs->context(
            //     1,
            //     1,
            //     erro: $e->getMessage()
            // ));
            // Log::error('Ocorreu um erro na execucao do codigo', [
            //     'url' => $request->fullUrl(),
            //     'request' => json_encode($request->all()),
            //     'error' => $e->getMessage(),
            //     // 'user_id' => auth()->check() ? auth()->id() : 'guest',
            // ]);

            // Log::error('An unexpected error occurred.', [
            //     'error' => $e->getMessage(),
            //     'trace' => $e->getTraceAsString(),
            //     'url' => $request->fullUrl(),
            //     // 'user_id' => auth()->check() ? auth()->id() : 'guest',
            // ]);

            // return redirect()->back()->with('warning', 'An unexpected error occurred. Please try again.');
        });
        // $exceptions->render(function (PDOException $e) {
        //     return false;
        // });
        // // Handling database query exceptions
        // $exceptions->render(function (QueryException $e, Request $request) {
            
        //     return redirect()->back()->with('warning', 'A database error occurred. Please try again.');
        // });

        // // Handling not found exceptions
        // $exceptions->render(function (NotFoundHttpException $e, Request $request) {
        //     if ($e->getPrevious() instanceof ModelNotFoundException) {
        //         Log::error('Model not found: ' . $e->getMessage(), [
        //             'error' => $e->getMessage(),
        //             'url' => $request->fullUrl(),
        //             // 'user_id' => auth()->check() ? auth()->id() : 'guest',
        //         ]);

        //         return redirect()->back()->with('warning', 'Requested resource not found.');
        //     }
        // });

        // // Handling validation exceptions
        // $exceptions->render(function (ValidationException $e, Request $request) {
        //     Log::error('Validation error: ' . $e->getMessage(), [
        //         // 'user_id' => auth()->id(),
        //         'url' => $request->fullUrl(),
        //         'input' => $request->all(),
        //     ]);

        //     return redirect()->back()->withErrors($e->validator)->withInput();
        // });
    })->create();
