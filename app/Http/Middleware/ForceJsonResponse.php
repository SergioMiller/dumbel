<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;

class ForceJsonResponse
{
    public function handle($request, Closure $next)
    {
        $request->headers->set('Accept', 'application/json');

        $response = $next($request);

        if ($response instanceof JsonResponse && config('app.debug') === true) {
            $queries = $this->getQueries();

            $response->setData($response->getData(true) + [
                '_debugbar' => [
                    'count' => count($queries),
                    'queries' => $queries,
                ],
            ]);
        }

        return $response;
    }

    private function getQueries(): array
    {
        return array_map(static function ($item) {
            return [
                'sql' => str_replace('"', '', $item['sql']),
                'file' => [
                    'name' => $item['backtrace'][0]->name,
                    'line' => $item['backtrace'][0]->line
                ],
                'duration' => $item['duration'],
            ];
        }, app('debugbar')->getData()['queries']['statements'] ?? []);
    }
}
