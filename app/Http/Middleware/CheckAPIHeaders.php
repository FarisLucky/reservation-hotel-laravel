<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAPIHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->headers->get("Accept") !== 'application/vnd.api+json') {
            $resp = new Response('', Response::HTTP_NOT_ACCEPTABLE);
            return $this->addCorrectContentType($resp);
        }

        if (
            $request->isMethod(Request::METHOD_PATCH) ||
            $request->isMethod(Request::METHOD_PUT)
        ){
            if ($request->headers->get('Content-Type') !== 'application/vnd.api+json') {
                return new Response('', Response::HTTP_UNSUPPORTED_MEDIA_TYPE);
            }
        }
        return $this->addCorrectContentType($next($request));
    }

    private function addCorrectContentType(Response $response): Response
    {
        $response->headers->set('Content-Type','application/vnd.api+json');
        return $response;
    }
}
