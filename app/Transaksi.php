<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $fillable = [
    	'id_akun','tgl','keterangan','pengeluaran','pemasukan','nominal','jumlah','saldo','u_id'
    ];

    protected $hidden = [
    	'created_at','updated_at'
    ];

    public function akun() {
    	return $this->belongsTo('App\NamaAkun','id_akun');
    }

}