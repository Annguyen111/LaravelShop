<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Utilities\Constant;
use App\Utilities\VNPay;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductLikes;

class CheckOutController extends Controller
{

    public function index()
    {
        $carts = Cart::content();
        $total = Cart::total();
        $subtotal = Cart::subtotal();
        if (isset(Auth::user()->id)){
            $productlikes = ProductLikes::where('user_id',Auth::user()->id)->get();
            return view('fontend.checkout.index',compact('carts','total','subtotal','productlikes'));
        }

        return view('fontend.checkout.index',compact('carts','total','subtotal'));
    }

    public function add(CheckoutRequest $request){


        //Thêm đơn hàng
        $data = $request->all();
        $data['status'] = Constant::order_status_ReceiveOrders;
        $order = Order::create($data);

        //Thêm chi tiết đơn hàng
        $carts = Cart::content();
        foreach ($carts as $cart){
            $data = [
                'order_id' => $order->id,
                'product_id' => $cart->id,
                'qty' => $cart->qty,
                'amount' => $cart->price,
                'total' => $cart->price * $cart->qty,
                'size' => $cart->options->size,
                'color' => $cart->options->color
            ];

            OrderDetail::create($data);
        }

        if ($request->payment_type == 'pay_later'){
            //Gửi mail
            $total = Cart::total();
            $subtotal = Cart::subtotal();
            $this->sendEmail($order,$total,$subtotal);

            //Xóa giỏ hàng
            Cart::destroy();

            //Trả về kết quả
            return redirect('checkout/result')
                ->with('notification','Success! You will pay on delivery. Please check your mail' );
        }

        if ($request->payment_type == 'online_payment'){
            //Lấy URL thanh toán VNPay
            $data_url = VNPay::vnpay_create_payment([
                'vnp_TxnRef' => $order->id,
                'vnp_OrderInfo' => 'Mô tả đơn hàng',
                'vnp_Amount' => Cart::total(0,'','') * 23075 //Nhân với tỉ giá để chuyển sang tiền việt nam
            ]);

            //Chuyển tới URL lấy được
            return redirect()->to($data_url);
        }

    }

    public function vnPayCheck(Request $request){
        //Lấy dâta từ URL (do vnPay gửi về qua  $vnp_Returnurl
        $vnp_ResponseCode = $request->get('vnp_ResponseCode');
        $vnp_TxnRef = $request->get('vnp_TxnRef');
        $vnp_Amount = $request->get('vnp_Amount');

        //Kiểm tra kết quả
        if ($vnp_ResponseCode != null){
            //Nếu thành công
            if ($vnp_ResponseCode == 00){
                //Cập nhật trạng thái Order
                Order::update([
                   'status' => Constant::order_status_Paid

                ], $vnp_TxnRef);

                //Gửi email
                $order = Order::find($vnp_TxnRef);
                $total = Cart::total();
                $subtotal = Cart::subtotal();
                $this->sendEmail($order,$total,$subtotal);

                //Xóa giỏ hàng
                Cart::destroy($order);


                //Thông báo kết quả
                return redirect('checkout/result')
                    ->with('notification','Success! You will pay on delivery. Please check your mail' );
            }else{
                //Xóa đơn hàng đã thêm vào DB và trả về thông báo lỗi
                Order::find($vnp_TxnRef)->delete();

                return redirect('checkout/result')
                    ->with('notification',"ERROR: Payment failed or canceled" );

            }
        }
    }

    public function result(){
        $notification = session('notification');

        return view('fontend.checkout.result',compact('notification'));
    }

    private function sendEmail($order,$total,$subtotal){
        $email_to = $order->email;
        Mail::send('fontend.checkout.email',compact('order','total','subtotal'), function($message) use ($email_to) {
            $message->from('annq7923@gmail.com','Fashi Shop');
            $message->to($email_to,$email_to);
            $message->subject('Order Notification');
        });
    }


}
