<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Kyslik\ColumnSortable\Sortable;     // 追加

class Message extends Model
{
    use Sortable;   // 追加

    protected $fillable = [
        'title',
        'name',
    ];

    public $sortable = ['title'];    // ソート対象カラム追加
}
