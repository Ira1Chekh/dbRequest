<?php


namespace App\Http\Controllers;

use App\Services\OrdersService;
use Illuminate\Http\Request;


/**
 * Class OrderController
 * @package App\Http\Controllers
 */
class OrderController
{
    /**
     * @var OrdersService
     */
    protected $ordersService;

    /**
     * OrderController constructor.
     * @param OrdersService $ordersService
     */
    public function __construct(OrdersService $ordersService)
    {
        $this->ordersService = $ordersService;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function union(Request $request)
    {
        return $this->ordersService->getOrdersUnion($request->query());
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function unionAll(Request $request)
    {
        return $this->ordersService->getOrdersUnionAll($request->query());
    }
}
