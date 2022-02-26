<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Kyslik\ColumnSortable\Sortable;     // 追加
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
    use Sortable;   // 追加
    use SoftDeletes;

    protected $fillable=[
        "name"
    ];

    public $sortable = ['name'];    // ソート対象カラム追加
}



