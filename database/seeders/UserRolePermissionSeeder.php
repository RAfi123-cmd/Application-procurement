<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $karyawan = Role::create(['name' => 'karyawan']);
        $staff_finance = Role::create(['name' => 'staff_finance']);
        $manager_finance = Role::create(['name' => 'manager_finance']);

        // create permissions
        $read_supplier = Permission::create(['name' => 'read supplier']);
        $create_supplier = Permission::create(['name' => 'create supplier']);
        $update_supplier = Permission::create(['name' => 'update supplier']);
        $delete_supplier = Permission::create(['name' => 'delete supplier']);

        $read_pengajuan = Permission::create(['name' => 'read pengajuan-pembelian-barang']);
        $create_pengajuan = Permission::create(['name' => 'create pengajuan-pembelian-barang']);
        $update_pengajuan = Permission::create(['name' => 'update pengajuan-pembelian-barang']);
        $delete_pengajuan = Permission::create(['name' => 'delete pengajuan-pembelian-barang']);

        $read_perbandingan = Permission::create(['name' => 'read perbandingan-harga']);
        $create_perbandingan = Permission::create(['name' => 'create perbandingan-harga']);
        $update_perbandingan = Permission::create(['name' => 'update perbandingan-harga']);
        $delete_perbandingan = Permission::create(['name' => 'delete perbandingan-harga']);

        $read_pemesanan = Permission::create(['name' => 'read pemesanan-barang']);
        $create_pemesanan = Permission::create(['name' => 'create pemesanan-barang']);
        $update_pemesanan = Permission::create(['name' => 'update pemesanan-barang']);
        $delete_pemesanan = Permission::create(['name' => 'delete pemesanan-barang']);

        $read_penerimaan = Permission::create(['name' => 'read penerimaan-barang']);
        $create_penerimaan = Permission::create(['name' => 'create penerimaan-barang']);
        $update_penerimaan = Permission::create(['name' => 'update penerimaan-barang']);
        $delete_penerimaan = Permission::create(['name' => 'delete penerimaan-barang']);

        // attach permission
        $karyawan->givePermissionTo([
            $read_pengajuan,
            $create_pengajuan,
            $update_pengajuan,
            $delete_pengajuan,
            $read_penerimaan
        ]);

        $staff_finance->givePermissionTo([
            $read_supplier,
            $create_supplier,
            $update_supplier,
            $delete_supplier,
            $read_pengajuan,
            $read_perbandingan,
            $create_perbandingan,
            $update_perbandingan,
            $delete_perbandingan,
            $read_pemesanan,
            $read_penerimaan,
            $create_penerimaan,
            $update_penerimaan,
            $delete_penerimaan
        ]);

        $manager_finance->givePermissionTo([
            $read_supplier,
            $read_pengajuan,
            $read_perbandingan,
            $read_pemesanan,
            $create_pemesanan,
            $update_pemesanan,
            $delete_pemesanan,
            $read_penerimaan,
        ]);
        
        // create user and assign role
        User::factory()->create([
            'name' => 'Karyawan',
            'email' => 'karyawan@procurement.com',
            'password' => bcrypt('password'),
        ])->assignRole($karyawan);

        User::factory()->create([
            'name' => 'Staff Finance',
            'email' => 'staff_finance@procurement.com',
            'password' => bcrypt('password'),
        ])->assignRole($staff_finance);

        User::factory()->create([
            'name' => 'Manager Finance',
            'email' => 'manager_finance@procurement.com',
            'password' => bcrypt('password'),
        ])->assignRole($manager_finance);
    }
}
