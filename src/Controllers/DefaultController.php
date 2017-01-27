<?php
namespace Simonetti\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DefaultController
 * @package Simonetti\Controllers
 */
class DefaultController
{

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function indexAction(Request $request): JsonResponse
    {
        return new JsonResponse(['Working', $request->headers->all()]);
    }
}