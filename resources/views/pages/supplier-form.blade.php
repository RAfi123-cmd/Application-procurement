<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $supplier->id ? 'Edit' : 'Tambah' }} Supplier</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg py-4">
                <div class="flex flex-col gap-2">
                    @session('error')
                        <div class="px-4">
                            <div class="p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                                {{ session('error') }}
                            </div>
                        </div>
                    @endsession
                    <div class="relative overflow-x-auto pt-4">
                        <form class="max-w-sm mx-auto" method="POST" action="{{ $supplier->id ? route('supplier.update', $supplier->id) : route('supplier.store') }}">
                            @csrf
                            @if ($supplier->id)
                                @method('put')
                            @endif
                            <div class="py-1">
                                <x-input-label for="nama_supplier" value="Nama Supplier" />
                                <x-text-input name="nama_supplier" id="nama_supplier" :value="$supplier->name ?? old('nama_supplier')" class="w-full p-2.5 text-sm" />
                                @error('nama_supplier')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="py-1">
                                <x-input-label for="email" value="Alamat E-mail" />
                                <x-text-input type="email" name="email" id="email" :value="$supplier->email ?? old('email')" class="w-full p-2.5 text-sm" />
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="py-1">
                                <x-input-label for="alamat" value="Alamat" />
                                <x-textarea-input name="alamat" id="alamat" :value="$supplier->alamat ?? old('alamat')" class="w-full p-2.5 text-sm" />
                                @error('alamat')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="py-1">
                                <x-input-label for="pic" value="PIC" />
                                <x-text-input type="text" name="pic" id="pic" :value="$supplier->pic ?? old('pic')" class="w-full p-2.5 text-sm" />
                                @error('pic')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="py-1">
                                <x-input-label for="kontak_pic" value="Kontak PIC" />
                                <x-text-input type="text" name="kontak_pic" id="kontak_pic" :value="$supplier->kontak_pic ?? old('kontak_pic')" class="w-full p-2.5 text-sm" />
                                @error('kontak_pic')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="py-1">
                                <a href="{{ route('supplier.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                    Kembali
                                </a>
                                <x-primary-button>Simpan</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>