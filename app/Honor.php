<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Honor extends Model
{
    protected $table = 'honor';
    protected $fillable = [
    	'tgl','category_id','nama','jumlah','jam','total'
    ];
    protected $hidden = [
    	'created_at','updated_at'
    ];

    public function category() {
    	return $this->belongsTo('App\Category');
    }
}
