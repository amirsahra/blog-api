<?php

namespace App\Http\Middleware;

use App\Models\V1\Post;
use App\Traits\ApiResponse;
use Closure;
use Illuminate\Http\Request;

class Author
{
    use ApiResponse;
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth('api')->check() && auth('api')->id() == $request->post->author_id)
            return $next($request);
        else
            return $this->apiResult(__('messages.unauthorized'), null, false, 401);
    }
}
