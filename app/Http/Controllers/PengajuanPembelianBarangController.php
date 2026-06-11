<?php

namespace App\Http\Controllers;

use App\Models\PengajuanPembelianBarang;
use Illuminate\Http\Request;

class PengajuanPembelianBarangController extends Controller
{
    public function index()
    {
       /**
         * @var \App\Models\User
         */
        $user = auth()->user();
        if ($user->cannot('read pengajuan-pembelian-barang')) {
            return abort(403, 'Kamu tidak memiliki hak akses ke halaman ini');
        }
        $list_pengajuan = PengajuanPembelianBarang::withCount('detail')
            ->with('user')
            ->where(function ($query) use ($user) {
                if ($user->hasRole('karyawan')) { //jika role user adalah karyawan
                    $query->where('user_id', $user->id);
                }
            })->paginate(10);
        return view('pages.pengajuan', compact('list_pengajuan'));
    }
}
