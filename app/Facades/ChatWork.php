<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ChatWork extends Facade {
    protected static function getFacadeAccessor() {
        return 'chatworkapi';
    }
}