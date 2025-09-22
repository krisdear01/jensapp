<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Orderdetails;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderRepository
{
    public function createOrder(array $data)
    {
        return Order::insertGetId($data);
    }

    public function createOrderDetails(array $data)
    {
        return Orderdetails::insert($data);
    }

    public function getPendingOrders()
    {
        return Order::where('order_status', 'pending')->get();
    }

    public function getCompleteOrders()
    {
        return Order::where('order_status', 'complete')->get();
    }

    public function getOrderById(int $order_id)
    {
        return Order::where('id', $order_id)->first();
    }

    public function getOrderDetailsByOrderId(int $order_id)
    {
        return Orderdetails::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
    }

    public function updateOrderStatus(int $order_id, string $status)
    {
        return Order::findOrFail($order_id)->update(['order_status' => $status]);
    }

    public function updateProductStock(int $product_id, int $quantity)
    {
        return Product::where('id', $product_id)->decrement('product_store', $quantity);
    }

    public function getDueOrders()
    {
        return Order::where('due', '>', '0')->orderBy('id', 'DESC')->get();
    }

    public function updateDue(int $order_id, float $due, float $pay)
    {
        return Order::findOrFail($order_id)->update(['due' => $due, 'pay' => $pay]);
    }
}
