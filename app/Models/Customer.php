<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Kyslik\ColumnSortable\Sortable;     // 追加


class Customer extends Model
{
    use Sortable;   // 追加


    protected $fillable = [
        'name',
        'category_id',
        'cw_id',
    ];
    public function categories(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public $sortable = ['name', 'cw_id'];    // ソート対象カラム追加
}
