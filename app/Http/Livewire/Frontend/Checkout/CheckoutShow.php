<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Mail\PlaceOrderMail;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Illuminate\Support\Str;

class CheckoutShow extends Component
{

    public $carts, $totalProductAmount = 0;
    public $fullname, $email, $phone, $pincode, $address, $payment_mode = NULL, $payment_id = NULL;

    protected $listeners = [
        'validationForAll',
        'transitionEmit'=>'paidOnlineOrder'
    ];

    function paidOnlineOrder($value){
        $this->payment_id = $value;
        $this->payment_mode = 'Paid by paypal';

        $codOrder = $this->placeOrder();
        if($codOrder){
            Cart::where('user_id',auth()->user()->id)->delete();
            $this->dispatchBrowserEvent(
                'message',
                [
                    'text' => 'Order Placed Successfully',
                    'type' => 'info',
                    'status' => 200
                ]
            );
            return redirect()->to('thank-you');
        }else{
            $this->dispatchBrowserEvent(
                'message',
                [
                    'text' => 'Something went wrong',
                    'type' => 'info',
                    'status' => 200
                ]
            );
        }

    }

    function validationForAll(){
        $this->validate();
    }



    function rules()
    {
        return [
            'fullname' => 'required|string|max:121',
            'email' => 'required|email|max:121',
            'phone' => 'required|string|max:11|min:10',
            'pincode' => 'required|string|max:6',
            'address' => 'required|string|max:500'
        ];
    }
    function placeOrder()
    {
        $this->validate();
        $order =    Order::create([
            'user_id' => auth()->user()->id,
            'tracking_no' => 'funda-' . Str::random(10),
            'fullname' => $this->fullname,
            'email' => $this->email,
            'phone' => $this->phone,
            'pincode' => $this->pincode,
            'address' => $this->address,
            'address' => $this->address,
            'status_message' => 'in progress',
            'payment_mode' => $this->payment_mode,
            'payment_id' => $this->payment_id
        ]);


        foreach ($this->carts as  $cartItem) {
            $orderItems = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product_color_id' => $cartItem->product_color_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->selling_price,
            ]);
            if($cartItem->product_color_id != NULL){
                $cartItem->productColor()->where('id',$cartItem->product_color_id)->decrement('quantity', $cartItem->quantity);
            }else{
                $cartItem->product()->where('id',$cartItem->product_color_id)->decrement('quantity', $cartItem->quantity);

            }
        }
        return $order;

    }




    function codOrder()
    {
        $this->payment_mode = 'Cash on Delivery';
        $codOrder = $this->placeOrder();

        try{
            //mail send successfully
            $order = Order::findOrFail($codOrder->id);
            Mail::to($order->email)->send(new PlaceOrderMail($order));
        }catch(\Exception $e){
            //something went wrong
        }


        if($codOrder){
            Cart::where('user_id',auth()->user()->id)->delete();
            $this->dispatchBrowserEvent(
                'message',
                [
                    'text' => 'Order Placed Successfully',
                    'type' => 'info',
                    'status' => 200
                ]
            );
            return redirect()->to('thank-you');
        }else{
            $this->dispatchBrowserEvent(
                'message',
                [
                    'text' => 'Something went wrong',
                    'type' => 'info',
                    'status' => 200
                ]
            );
        }
    }

    function totalProductAmount()
    {
        $this->totalProductAmount = 0;
        $this->carts = Cart::where('user_id', auth()->user()->id)->get();
        foreach ($this->carts as  $cartItem) {
            $this->totalProductAmount += $cartItem->product->selling_price * $cartItem->quantity;
        }
        return $this->totalProductAmount;
    }


    public function render()
    {
        $this->fullname = auth()->user()->name;
        $this->email = auth()->user()->email;



        $this->totalProductAmount = $this->totalProductAmount();

        return view('livewire.frontend.checkout.checkout-show', [
            'totalProductAmount' => $this->totalProductAmount
        ]);
    }
}
