<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViewProduct extends Model
{
    public $fillable = ['product_id', 'view_by'];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function scopeView($query, $product_id, $user_id=0)
    {
        $already_exist = $query->where('product_id', $product_id)
                ->where('view_by', $user_id)
                ->get();

        // dd($already_exist->isEmpty());
        if ($already_exist->isEmpty()) {
            return $query->create([
                'product_id' => $product_id,
                'view_by' => $user_id
            ]);
        }
    }
}
