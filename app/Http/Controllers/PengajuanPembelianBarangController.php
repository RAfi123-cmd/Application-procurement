<?php

namespace App\Http\Controllers;

use App\Models\PengajuanPembelianBarang;
use App\Models\PengajuanPembelianBarangDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function create(PengajuanPembelianBarang $pengajuan_pembelian_barang)
    {
       
        $user = auth()->user();
        if ($user->cannot('create pengajuan-pembelian-barang')) {
            return abort(403, 'Kamu tidak memiliki hak akses ke halaman ini');
        }
        return view('pages.pengajuan-form-input', ['pengajuan' => $pengajuan_pembelian_barang]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_pengajuan' => 'required|max:255',
            'keterangan' => 'required',
            'nama_barang' => 'required|array|min:1',
            'nama_barang.*' => 'required',
            'jumlah' => 'required|array|min:1',
            'jumlah.*' => 'required|numeric',
            'harga_satuan' => 'required|array|min:1',
            'harga_satuan.*' => 'required|numeric',
            'spesifikasi' => 'required|array|min:1',
            'spesifikasi.*' => 'required',
        ], [
            'nama_barang.*.required' => 'Nama barang wajib diisi',
            'jumlah.*.required' => 'Jumlah barang wajib diisi',
            'harga_satuan.*.required' => 'Harga satuan barang wajib diisi',
            'spesifikasi.*.required' => 'Spesifikasi barang wajib diisi',
        ]);
        DB::beginTransaction();
        try {
            $pengajuan = PengajuanPembelianBarang::create([
                'nomor' => numbering('pengajuan_pembelian_barang', 'PPB' . date('ym')),
                'nama_pengajuan' => $request->nama_pengajuan,
                'keterangan' => $request->keterangan,
                'user_id' => auth()->user()->id
            ]);
            $list_barang = [];
            foreach ($request->nama_barang as $key => $nama_barang) {
                $list_barang[] = new PengajuanPembelianBarangDetail([
                    'nama_barang' => $nama_barang,
                    'spesifikasi' => $request->spesifikasi[$key],
                    'jumlah' => $request->jumlah[$key],
                    'harga_satuan' => $request->harga_satuan[$key]
                ]);
            }
            $pengajuan->detail()->saveMany($list_barang);
            DB::commit();
            return redirect('pengajuan-pembelian-barang')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
