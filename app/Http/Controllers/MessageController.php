<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
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
    public function index()
    {
        $messages = Message::sortable()->orderBy('title', 'asc')->paginate(4);

         return view('message.index', ['messages' => $messages]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //クライアント側に表示させる
        return view('message.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //登録ボタンを押したときに実行される
        $validated = $request->validate([
            'title' => 'required',
            'message' => 'required',
        ]);

        Message::create([
            'title' => $request->title,
            'name'  => $request->message
        ]);
        return redirect(route('message.index'))->with(['flash_message' => '登録が完了致しました。']);
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
        $message = Message::find($id);
        return view('message.edit', ['message' => $message]);
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
            'title' => 'required',
            'message' => 'required',
        ]);
        //編集ページの編集ボタンを押したときに
        //そのidのレコードに対して値があれば実行される
        $messages = Message::find($id);
        $messages->title = $request->title;
        $messages->name = $request->message;
        $messages->save();
        return redirect("/message")->with(['flash_message' => '変更が完了致しました。']);
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
        $message = Message::findOrFail($id);
        $message->delete();
        return redirect("/message")->with(['flash_message' => '削除が完了致しました。']);

    }
}
