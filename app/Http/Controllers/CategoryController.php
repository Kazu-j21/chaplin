<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Customer;


class CategoryController extends Controller
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
        $categories = Category::sortable()->orderBy('name', 'asc')->paginate(3);

         #キーワード受け取り
        $keyword = $request->input('keyword');

        #クエリ生成
        $query = Category::query();

        #もしキーワードがあったら
        if(!empty($keyword))
        {
            $categories = $query->where('name','like','%'.$keyword.'%')->paginate(3);
        }

        return view('category.index', ['categories' => $categories])->with('keyword',$keyword);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
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
        ]);
        Category::create([
            "name" =>$request->name,
        ]);
        return redirect("/category")->with(['flash_message' => '登録が完了致しました。']);
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
        $category = Category::find($id);
        return view('category.edit', ['category' => $category]);
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
        ]);

        $category = Category::findOrFail($id);

        $category->name = $request->name;

        $category->save();

        return redirect("/category")->with(['flash_message' => '編集が完了致しました。']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $customers = Customer::where('category_id', $id)->update(['category_id' => 0]);
        $category->delete();
        return redirect("/category")->with(['flash_message' => '削除が完了致しました。']);
    }
}
