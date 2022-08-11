<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\Carts;
use App\Models\Order;

class OrderService
{
    protected $cartModel;

    public function __construct()
    {
        $orderModel = new Order();
        $this->orderModel = $orderModel;
    }

    public function getDataIndex($key_search = null,$arr = null)
    {
        return $this->orderModel->getDataIndex($key_search,$arr);
    }
}
