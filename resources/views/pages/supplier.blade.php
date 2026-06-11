<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Supplier</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl ms-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
                <div class="flex flex-col gap-2">
                    <div>
                        <a href="{{ route('supplier.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent
                            rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white
                            focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 
                            focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-outduration-150">
                            Tambah
                        </a>
                    </div>
                    @session('success')
                        <div>
                            <div class="px-4">
                                <div class="p-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert"">
                                    <span class="font-medium">Sukses!</span> {{ session('success') }}.
                                </div>
                            </div>
                        </div>
                    @endsession
                    @session('error')
                        <div>
                            <div class="px-4">
                                <div class="p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert"">
                                    <span class="font-medium">Error!</span> {{ session('error') }}.
                                </div>
                            </div>
                        </div>
                    @endsession
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Nomor
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nama Supplier
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Alamat
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        PIC
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Kontak PIC
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suppliers as $supplier)
                                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $supplier->nomor }}
                                        </th>
                                        <td class="px-6 py-4">{{ $supplier->name }}</td>
                                        <td class="px-6 py-4">{{ $supplier->email }}</td>
                                        <td class="px-6 py-4">{{ $supplier->alamat }}</td>
                                        <td class="px-6 py-4">{{ $supplier->pic }}</td>
                                        <td class="px-6 py-4">{{ $supplier->kontak_pic }}</td>
                                        <td class="px-6 py-4">
                                             <a href="{{ route('supplier.edit', $supplier->id) }}" class="font-medium text-blue-600 me-1 dark:text-blue-500 hover:underline">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div>
                        {!! $suppliers->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>