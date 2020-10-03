<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\MenuItem;
use App\Order;
use App\OrderItem;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class OrderController extends Controller
{
    public $successStatus = 200;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('user_id', \Auth::user()->id)->get();
        foreach ($orders as $order) {
            $order->item = OrderItem::where('order_id', $order->id)->first();
        }
        return response()->json(['success' => $orders], $this-> successStatus);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order;
        $order->user_id = \Auth::user()->id;
        $order->order_type_id = $request->order_type_id;
        $order->total = 0;
        $order->note = $request->note;
        $order->payment_id = 1;
        $order->status_id = 1;
        $order->save();

        foreach(json_decode($request->items) as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->item_id = $item->id;
            $orderItem->quantity = 1;
            $orderItem->note = "";
            $orderItem->save();
            $order->total = round($order->total + MenuItem::find($item->id)->price, 2);
        }
        $order->save();

        $twilio = new Client(env('TWILLO_ID'), env('TWILLO_TOKEN'));
        $message = $twilio->messages->create("whatsapp:".\Auth::user()->phone,[
            "from" => "whatsapp:+14155238886",
            "body" => "Thank You for placing your order with FoodRocket."
        ]);

        return response()->json(['success' => $order], $this-> successStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
