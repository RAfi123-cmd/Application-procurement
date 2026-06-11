<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanPembelianBarangDetail extends Model
{
    use HasFactory;
    protected $table = 'pengajuan_pembelian_barang_detail';
    protected $guarded = ['id'];
    public $timestamps = false;
    public function pengajuan()
    {
        return $this->belongsTo(PengajuanPembelianBarang::class, 'pengajuan_id');
    }
}
