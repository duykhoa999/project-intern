<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\CompanyOrder;
use Exception;

class CompanyOrderService
{
    protected $orderModel;

    public function __construct(CompanyOrder $orderModel)
    {
        $this->orderModel = $orderModel;
    }

    public function create($data)
    {
        $order = CompanyOrder::create($data);
        try {
            $order->save();
        } catch (Exception $e) {
            return false;
        }
        return $order;
    }

    public function update($order, $data)
    {
        try {
            $order->update($data);
        } catch (Exception $e) {
            return false;
        }
        return $order;
    }

    // public function getDataIndex($key_search = null)
    // {
    //     return $this->orderModel->getDataIndex($key_search);
    // }
}
