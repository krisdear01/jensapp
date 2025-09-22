<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Models\Product;
use App\Models\Order;

class OrderController extends Controller
{
    protected $orderService;

    protected $productService;

    public function __construct(OrderService $orderService, \App\Services\ProductService $productService)
    {
        $this->orderService = $orderService;
        $this->productService = $productService;
    }

    public function FinalInvoice(Request $request)
    {
        $this->orderService->createInvoice($request);

        $notification = array(
            'message' => 'Order Complete Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('dashboard')->with($notification);
    }

    public function PendingOrder()
    {
        $orders = $this->orderService->getPendingOrders();
        return view('backend.order.pending_order', compact('orders'));
    }

    public function CompleteOrder()
    {
        $orders = $this->orderService->getCompleteOrders();
        return view('backend.order.complete_order', compact('orders'));
    }

    public function OrderDetails($order_id)
    {
        $data = $this->orderService->getOrderDetails($order_id);
        return view('backend.order.order_details', $data);
    }

    public function OrderStatusUpdate(Request $request)
    {
        $this->orderService->approveOrder($request->id);

        $notification = array(
            'message' => 'Order Done Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('pending.order')->with($notification);
    }

    public function StockManage()
    {
        $product = $this->productService->getAllProducts();
        return view('backend.stock.all_stock', compact('product'));
    }

    public function OrderInvoice($order_id)
    {
        return $this->orderService->generateInvoicePdf($order_id);
    }

    public function PendingDue()
    {
        $alldue = $this->orderService->getDueOrders();
        return view('backend.order.pending_due', compact('alldue'));
    }

    public function OrderDueAjax($id)
    {
        $order = $this->orderService->getOrderById($id);
        return response()->json($order);
    }

    public function UpdateDue(Request $request)
    {
        $this->orderService->updateDue($request);

        $notification = array(
            'message' => 'Due Amount Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('pending.due')->with($notification);
    }
}
 