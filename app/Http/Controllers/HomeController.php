<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Category;
use App\Models\Message;
use App\Facades\ChatWork;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('bydAuth');
    }

    public function index(Request $request)
    {
        $checked = $request->checked;
        $select_checkbox = $request->selectcustomer ?? [];
        $messages = Message::all();
        $categories = Category::all();

        if($request->category_id == 0){
            $customers = Customer::all();
            $customerCategoryId = 0;
        }
        else{
            $customers = Customer::where('category_id', $request->category_id)->get();
            $customerCategoryId = $request->category_id;
        }

        if(isset($request->message_id)){
            $selectmessage = Message::find($request->message_id);
        }
        else{
            $selectmessage = Message::first();
        }
        return view('home.index', [
            'customers'     => $customers,
            'categories'    => $categories,
            'messages'      => $messages,
            'selectmessage' => $selectmessage,
            'customerCategoryId' => $customerCategoryId,
            'selectCheckbox' => $select_checkbox
        ]);

    }
    public function send(Request $request)
    {
        $cwIds   = $request->postCustomers;
        $message = $request->postMessage;

        if( !empty($cwIds) && !empty($message) ){
            // チャットワーク一括送信
            foreach ($cwIds as $cwId) {
                ChatWork::messageSend($cwId, $message);
            }
            return redirect('/home')->with(['flash_message' => '送信が完了致しました。']);
        }else{
            return redirect('/home')->with(['flash_error_message' => '未入力の箇所があります。']);
        }
    }
}
