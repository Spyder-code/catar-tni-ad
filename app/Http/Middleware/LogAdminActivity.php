<?php

namespace App\Http\Middleware;

use App\Models\AdminActivityLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class LogAdminActivity
{
    public function handle(Request $request, Closure $next)
    {
        // Capture the actor before logout clears the authenticated session.
        $actor = $request->user();
        try {
            $response = $next($request);
            $status = $response->getStatusCode();
        } catch (Throwable $exception) {
            $status = $exception instanceof HttpExceptionInterface ? $exception->getStatusCode() : 500;
            $this->record($request, $actor ?: $request->user(), $status);
            throw $exception;
        }

        // Login only has an authenticated user after the controller runs.
        $this->record($request, $actor ?: $request->user(), $status);

        return $response;
    }

    private function record(Request $request, $actor, int $status): void
    {
        if (!$actor || !in_array($actor->role, ['admin', 'superadmin'], true)) {
            return;
        }

        // Older test fixtures may not include this migration yet.
        if (!Schema::hasTable('admin_activity_logs')) {
            return;
        }

        $route = $request->route();
        $routeName = $route ? $route->getName() : null;
        $action = $this->action($request, $routeName);

        AdminActivityLog::create([
            'user_id' => $actor->id,
            'user_name' => $actor->name,
            'user_role' => $actor->role,
            'action' => $action,
            'method' => $request->method(),
            'route_name' => $routeName,
            'path' => mb_substr($request->path(), 0, 500),
            'status_code' => $status,
            'ip_address' => $request->ip(),
            'user_agent' => mb_substr((string) $request->userAgent(), 0, 500),
        ]);
    }

    private function action(Request $request, ?string $routeName): string
    {
        if ($request->isMethod('POST') && $request->is('login')) {
            return 'login';
        }
        if ($routeName === 'logout') {
            return 'logout';
        }
        if ($routeName && str_contains($routeName, 'export')) {
            return 'export';
        }
        if ($routeName && str_contains($routeName, 'import')) {
            return 'import';
        }
        if ($routeName && (str_contains($routeName, 'print') || str_contains($routeName, 'pdf'))) {
            return 'print';
        }
        if ($routeName && (str_contains($routeName, 'destroy') || str_contains($routeName, 'delete'))) {
            return 'delete';
        }
        if ($request->isMethod('DELETE')) {
            return 'delete';
        }
        if ($request->isMethod('GET')) {
            return $request->is('sync/date') ? 'update' : 'view';
        }
        if ($routeName && str_contains($routeName, 'store')) {
            return 'create';
        }

        return 'update';
    }
}
