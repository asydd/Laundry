<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('PAKET') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <div>DATA PAKET</div>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100 flex gap-5">
                    {{-- FORM ADD SUPPLIER --}}
                    <div class="w-full bg-gray-100 p-4 rounded-xl">
                        <div class="mb-5">INPUT DATA PAKET</div>
                        <form action="{{ route('paket.store') }}" method="post">
                            @csrf
                            <div class="mb-5">
                                <label for="id_outlet" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Outlet</label>
                                <select class="js-example-placeholder-single js-states form-control w-full" name="id_outlet" data-placeholder="Pilih outlet">
                                    <option value=""></option>
                                    @foreach ($outlet as $k)
                                        <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-5">
                                <label for="jenis" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">JENIS</label>
                                <select id="jenis" name="jenis" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <option value=""></option>
                                    <option value="Tas">Tas</option>
                                    <option value="Celana">Celana</option>  
                                    <option value="Jaket">Jaket</option>
                                    <option value="Karpet">Karpet</option>
                                </select>
                            </div>
                            <div class="mb-5">
                                <label for="nama_paket" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NAMA_PAKET</label>
                                <input name="nama_paket" type="text" id="nama_paket" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            </div>
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5">SIMPAN</button>
                        </form>
                    </div>

                    {{-- TABLE SUPPLIER --}}
                    <div class="w-full">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            NO</th>
                                        <th class="px-6 py-3">Id_Outlet</th>
                                        <th class="px-6 py-3">Jenis</th>
                                        <th class="px-6 py-3">Nama_Paket</th>
                                        <th class="px-6 py-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($paket as $key => $k)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $paket->perPage() * ($paket->currentPage() - 1) + $key + 1 }}
                                        </th>
                                            <td class="px-6 py-4">{{ $k->id_outlet }}</td>
                                            <td class="px-6 py-4">{{ $k->jenis }}</td>
                                            <td class="px-6 py-4">{{ $k->nama_paket }}</td>
                                            <td class="px-6 py-4">
                                                <button type="button" data-id="{{ $k->id }}" data-id_outlet="{{ $k->id_outlet }}" data-jenis="{{ $k->jenis }}" data-nama_paket="{{ $k->nama_paket }}" onclick="editSourceModal(this)" class="bg-amber-500 hover:bg-amber-600 px-3 py-1 rounded-md text-xs text-white">Edit</button>
                                                <button onclick="paketDelete('{{ $k->id }}','{{ $k->nama_paket }}')" class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded-md text-xs text-white">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">{{ $paket->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Edit -->
    <div class="fixed inset-0 flex items-center justify-center z-50 hidden" id="sourceModal">
        <div class="fixed inset-0 bg-black opacity-50"></div>
        <div class="fixed inset-0 flex items-center justify-center">
            <div class="w-full md:w-1/2 relative bg-white rounded-lg shadow mx-5">
                <div class="flex items-start justify-between p-4 border-b">
                    <h3 class="text-xl font-semibold text-gray-900" id="title_source">Update Paket</h3>
                    <button type="button" onclick="sourceModalClose()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg w-8 h-8">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form method="POST" id="formSourceModal">
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="p-4 space-y-6">
                        <div>
                            <label for="id_outlet_edit" class="block mb-2 text-sm font-medium text-gray-900">ID Outlet</label>
                            <input type="text" id="id_outlet_edit" name="id_outlet" class="bg-gray-50 border border-gray-300 text-sm rounded-lg w-full p-2.5">
                        </div>
                        <div>
                            <label for="jenis_edit" class="block mb-2 text-sm font-medium text-gray-900">Jenis</label>
                            <input type="text" id="jenis_edit" name="jenis" class="bg-gray-50 border border-gray-300 text-sm rounded-lg w-full p-2.5">
                        </div>
                        <div>
                            <label for="nama_paket_edit" class="block mb-2 text-sm font-medium text-gray-900">Nama Paket</label>
                            <input type="text" id="nama_paket_edit" name="nama_paket" class="bg-gray-50 border border-gray-300 text-sm rounded-lg w-full p-2.5">
                        </div>
                    </div>
                    <div class="p-4 space-x-2 border-t">
                        <button type="submit" class="bg-green-400 m-2 w-40 h-10 rounded-xl hover:bg-green-500">Simpan</button>
                        <button type="button" onclick="sourceModalClose()" class="bg-red-500 m-2 w-40 h-10 rounded-xl text-white hover:bg-red-600">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    const editSourceModal = (button) => {
        const id = button.dataset.id;
        const id_outlet = button.dataset.id_outlet;
        const jenis = button.dataset.jenis;
        const nama_paket = button.dataset.nama_paket;

        document.getElementById('title_source').innerText = `UPDATE Paket ${nama_paket}`;
        document.getElementById('id_outlet_edit').value = id_outlet;
        document.getElementById('jenis_edit').value = jenis;
        document.getElementById('nama_paket_edit').value = nama_paket;

        let url = "{{ route('paket.update', ':id') }}".replace(':id', id);
        document.getElementById('formSourceModal').setAttribute('action', url);
        document.getElementById('sourceModal').classList.remove('hidden');
    };

    const sourceModalClose = () => {
        document.getElementById('sourceModal').classList.add('hidden');
    };

    const paketDelete = async (id, paket) => {
        if (confirm(`Apakah anda yakin untuk menghapus paket ${paket}?`)) {
            try {
                await axios.post(`/paket/${id}`, {
                    _method: 'DELETE',
                    _token: '{{ csrf_token() }}'
                });
                location.reload();
            } catch (error) {
                alert('Error deleting record');
                console.log(error);
            }
        }
    };
</script>
