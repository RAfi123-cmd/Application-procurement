<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanPembelianBarang extends Model
{
    //
    use HasFactory;
    protected $table = 'pengajuan_pembelian_barang';
    protected $guarded = ['id'];
    public $timestamps = false;
    public function detail()
    {
        return $this->hasMany(PengajuanPembelianBarangDetail::class, 'pengajuan_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
