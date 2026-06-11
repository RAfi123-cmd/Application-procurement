<?php
namespace App\Http\Controllers;
use App\Models\Supplier;
use Illuminate\Http\Request;
class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::paginate(10);
        return view('pages.supplier', compact('suppliers'));
    }
    public function create(Supplier $supplier)
    {
        return view('pages.supplier-form', compact('supplier'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required|max:255',
            'email' => 'required|email|max:255',
            'alamat' => 'required',
            'pic' => 'required|max:255',
            'kontak_pic' => 'required|max:15'
        ]);
        try {
            Supplier::create([
                'nomor' => numbering('supplier', 'S' . date('ym')),
                'name' => $request->nama_supplier,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'pic' => $request->pic,
                'kontak_pic' => $request->kontak_pic
            ]);
            return redirect('supplier')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data gagal disimpan');
        }
    }
}