<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontReport = [];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if ($request->expectsJson()) {
            return parent::render($request, $e);
        }

        $class = get_class($e);

        $code = 500;
        if (method_exists($e, 'getStatusCode')) {
            $code = $e->getStatusCode();
        } elseif ($e instanceof \Illuminate\Auth\AuthenticationException) {
            $code = 401;
        } elseif ($e instanceof \Illuminate\Auth\Access\AuthorizationException) {
            $code = 403;
        }

        $info = $this->humanInfo($e, $class);

        return response()->view('errors.friendly', [
            'code'        => $code,
            'title'       => $info['title'],
            'explanation' => $info['explanation'],
            'tip'         => $info['tip'],
            'technical'   => $e->getMessage(),
            'showTrace'   => config('app.debug', false),
            'trace'       => $e->getTraceAsString(),
        ], $code);
    }

    private function humanInfo(Throwable $e, string $class): array
    {
        if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            $model = class_basename($e->getModel());
            return [
                'title'       => 'Записът не е намерен',
                'explanation' => "Търсеният запис (<strong>{$model}</strong>) не съществува в базата — вероятно е изтрит или е подаден грешен ID.",
                'tip'         => 'Върни се към списъка и избери съществуващ запис.',
            ];
        }
        if ($e instanceof \Illuminate\Routing\Exceptions\UrlGenerationException) {
            return [
                'title'       => 'Грешка при генериране на URL адрес',
                'explanation' => 'На маршрута му липсва задължителен параметър (например ID). Формата вика <code>route(\'name\')</code> без да подава <code>$record->id</code>.',
                'tip'         => 'Поправи blade файла: <code>route(\'name\', $record->id)</code>.',
            ];
        }
        if ($e instanceof \Illuminate\Auth\AuthenticationException) {
            return [
                'title'       => 'Не си влязъл в профила си',
                'explanation' => 'Тази страница изисква да си логнат потребител.',
                'tip'         => 'Влез в профила си и опитай отново.',
            ];
        }
        if ($e instanceof \Illuminate\Auth\Access\AuthorizationException) {
            return [
                'title'       => 'Нямаш права за това',
                'explanation' => 'Акаунтът ти няма необходимите права за тази операция.',
                'tip'         => 'Свържи се с администратор.',
            ];
        }
        if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            return [
                'title'       => 'Страницата не е намерена (404)',
                'explanation' => 'Адресът не съществува на този сървър.',
                'tip'         => 'Провери URL адреса или използвай менюто.',
            ];
        }
        if ($e instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException) {
            return [
                'title'       => 'Грешен HTTP метод',
                'explanation' => 'Формата изпраща заявка с грешен метод (GET вместо POST или обратно).',
                'tip'         => 'Провери дали формата има <code>method="POST"</code> и <code>@csrf</code>.',
            ];
        }
        if (str_contains($class, 'QueryException') || str_contains($class, 'PDOException')) {
            return [
                'title'       => 'Грешка в базата данни',
                'explanation' => 'SQL заявката се провали — грешна колона, нарушена уникалност или проблем с връзката.',
                'tip'         => 'Провери migration файловете: <code>php artisan migrate:status</code>.',
            ];
        }
        if (str_contains($class, 'ViewException') || str_contains($class, 'ErrorException')) {
            return [
                'title'       => 'Грешка в blade шаблона',
                'explanation' => 'Нещо се счупи при рендирането на view файла — вероятно несъществуваща променлива или include.',
                'tip'         => 'Провери дали контролерът подава всички нужни данни към view-а.',
            ];
        }
        return [
            'title'       => 'Възникна неочаквана грешка',
            'explanation' => 'Нещо се обърка. Техническите детайли са по-долу.',
            'tip'         => 'Ако грешката се повтаря, провери <code>storage/logs/laravel.log</code>.',
        ];
    }
}
