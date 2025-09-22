<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderService
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function createInvoice(Request $request)
    {
        $rtotal = $request->total;
        $rpay = $request->pay;
        $mtotal = $rtotal - $rpay;

        $data = [
            'customer_id' => $request->customer_id,
            'order_date' => $request->order_date,
            'order_status' => 'pending',
            'total_products' => $request->total_products,
            'sub_total' => $request->sub_total,
            'vat' => $request->vat,
            'invoice_no' => 'EPOS' . mt_rand(10000000, 99999999),
            'total' => $request->total,
            'payment_status' => $request->payment_status,
            'pay' => $request->pay,
            'due' => $mtotal,
            'created_at' => Carbon::now(),
        ];

        $order_id = $this->orderRepository->createOrder($data);
        $contents = Cart::content();

        foreach ($contents as $content) {
            $pdata = [
                'order_id' => $order_id,
                'product_id' => $content->id,
                'quantity' => $content->qty,
                'unitcost' => $content->price,
                'total' => $content->total,
            ];
            $this->orderRepository->createOrderDetails($pdata);
        }

        Cart::destroy();
    }

    public function getPendingOrders()
    {
        return $this->orderRepository->getPendingOrders();
    }

    public function getCompleteOrders()
    {
        return $this->orderRepository->getCompleteOrders();
    }

    public function getOrderDetails(int $order_id)
    {
        $order = $this->orderRepository->getOrderById($order_id);
        $orderItem = $this->orderRepository->getOrderDetailsByOrderId($order_id);
        return compact('order', 'orderItem');
    }

    public function approveOrder(int $order_id)
    {
        $products = $this->orderRepository->getOrderDetailsByOrderId($order_id);
        foreach ($products as $item) {
            $this->orderRepository->updateProductStock($item->product_id, $item->quantity);
        }

        $this->orderRepository->updateOrderStatus($order_id, 'complete');
    }

    public function generateInvoicePdf(int $order_id)
    {
        $orderData = $this->getOrderDetails($order_id);
        $pdf = Pdf::loadView('backend.order.order_invoice', $orderData)->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    }

    public function getDueOrders()
    {
        return $this->orderRepository->getDueOrders();
    }

    public function updateDue(Request $request)
    {
        $order_id = $request->id;
        $due_amount = $request->due;

        $order = $this->orderRepository->getOrderById($order_id);
        $maindue = $order->due;
        $mainpay = $order->pay;

        $paid_due = $maindue - $due_amount;
        $paid_pay = $mainpay + $due_amount;

        $this->orderRepository->updateDue($order_id, $paid_due, $paid_pay);
    }
}
