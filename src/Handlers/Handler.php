<?php

namespace KUHdo\Survey\Handlers;

use BadMethodCallException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

abstract class Handler extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Execute an action on the handler.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return Response
     *
     * @noinspection PhpMissingReturnTypeInspection because of parent Controller
     */
    public function callAction($method, $parameters)
    {
        if ($method === '__invoke') {
            return call_user_func_array([$this, $method], $parameters);
        }
        throw new BadMethodCallException('Only __invoke method can be called on handler.');
    }
}
