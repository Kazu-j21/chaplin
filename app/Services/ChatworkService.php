<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;

/**
* @brief
* ChatworkServiceクラスは商品が新規投稿された後に、チャットワーク通知を行う処理を生成します。
* Chatwork API (メソッド：POST, URL：/rooms/{room_id}/messages) を使用します。
* ChatworkServiceクラスはFacadeのChatWorkクラスを通して呼び出しています。
*/
class ChatworkService
{
    protected $api_key;
    protected $url;
    protected $room_id;

    public function __construct()
    {
        $this->api_key = config('services.chatwork.key'); // APIキー
        $this->url     = config('services.chatwork.url'); // API URL
    }

    public function messageSend($cwId, $message)
    {
        //送信するメッセージの値
        $params = [
            'body' => $message
        ];

        $options = [
            CURLOPT_URL => $this->url . "/rooms"."/".$cwId."/messages",
            CURLOPT_HTTPHEADER => array('X-ChatWorkToken: '. $this->api_key),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($params, '', '&'),
        ];
        // curlでChatworkへメッセージを送信
        $ch = curl_init();
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response);
    }
}
