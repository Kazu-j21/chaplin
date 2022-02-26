<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Category;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('bydAuth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = Customer::with(["categories"]);

        $category_keyword = $request->input('category_keyword');

        $customer_keyword = $request->input('customer_keyword');

        $cw_id_keyword = $request->input('cw_id_keyword');

        if(!empty($customer_keyword))
        {
            $customers = $customers->where('name','like','%'.$customer_keyword.'%');
        }

        if(!empty($cw_id_keyword))
        {
            $customers = $customers->where('cw_id','like','%'.$cw_id_keyword.'%');
        }

        if(!empty($category_keyword))
        {
            $customers = $customers->whereHas('categories', function($query) use ($category_keyword) {
                $query->where('name','like','%'.$category_keyword.'%');
            });
        }

        return view('customer.index', ['customers' => $customers->sortable()
        ->orderBy('name', 'asc')->orderBy('cw_id', 'asc')->paginate(4)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('customer.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'cw_id' => 'required',
        ]);
        //登録ボタンを押したときに実行される
        $customer = Customer::create([
            'name' => $request->name,
            'category_id' =>$request->category_id,
            'cw_id' => $request->cw_id
        ]);

        return redirect("/customer")->with(['flash_message' => '登録が完了致しました。']);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        $categories = Category::all();
        return view('customer.edit',['customer' => $customer, 'categories' => $categories]);
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
        $validated = $request->validate([
            'name' => 'required',
            'cw_id' => 'required',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->name = $request->name;
        $customer->category_id = $request->category_id;
        $customer->cw_id = $request->cw_id;
        $customer->save();
        return redirect("/customer")->with(['flash_message' => '変更が完了致しました。']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return redirect("/customer")->with(['flash_message' => '削除が完了致しました。']);

    }
}
