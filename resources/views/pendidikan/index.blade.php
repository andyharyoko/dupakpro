<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pendidikan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <h3 class="text-lg font-bold mb-4">Tambah Data Pendidikan</h3>
                <form action="{{ route('pendidikan.store') }}" method="POST" class="mb-8">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="uraian_kegiatan" value="Uraian Kegiatan" />
                            <x-text-input id="uraian_kegiatan" name="uraian_kegiatan" type="text" class="mt-1 block w-full" required />
                        </div>
                        <div>
                            <x-input-label for="semester" value="Semester" />
                            <select id="semester" name="semester" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="TA 2025/2026 Genap">TA 2025/2026 Genap</option>
                                <option value="TA 2025/2026 Ganjil">TA 2025/2026 Ganjil</option>
                                <option value="TA 2024/2025 Genap">TA 2024/2025 Genap</option>
                                <option value="TA 2024/2025 Ganjil">TA 2024/2025 Ganjil</option>
                                <option value="TA 2023/2024 Genap">TA 2023/2024 Genap</option>
                                <option value="TA 2023/2024 Ganjil">TA 2023/2024 Ganjil</option>
                                <option value="TA 2022/2023 Genap">TA 2022/2023 Genap</option>
                                <option value="TA 2022/2023 Ganjil">TA 2022/2023 Ganjil</option>
                                <option value="TA 2021/2022 Genap">TA 2021/2022 Genap</option>
                                <option value="TA 2021/2022 Ganjil">TA 2021/2022 Ganjil</option>
                                <option value="TA 2020/2021 Genap">TA 2020/2021 Genap</option>
                                <option value="TA 2020/2021 Ganjil">TA 2020/2021 Ganjil</option>
                            </select>
                        </div>
                        
                        <div>
                            <x-input-label for="satuan_hasil" value="Satuan Hasil" />
                            <x-text-input id="satuan_hasil" name="satuan_hasil" type="text" class="mt-1 block w-full" />
                        </div>
                        <div>
                            <x-input-label for="volume" value="Volume Kegiatan" />
                            <x-text-input id="volume" name="volume" type="number" step="0.01" class="mt-1 block w-full" required />
                        </div>
                        <div>
                            <x-input-label for="angka_kredit" value="Angka Kredit" />
                            <x-text-input id="angka_kredit" name="angka_kredit" type="number" step="0.01" class="mt-1 block w-full" required />
                        </div>
                        <div>
                            <x-input-label for="keterangan" value="Keterangan / Bukti Fisik" />
                            <x-text-input id="keterangan" name="keterangan" type="text" class="mt-1 block w-full" />
                        </div>
                    </div>
                    <div class="mt-4">
                        <x-primary-button>Simpan</x-primary-button>
                    </div>
                </form>

                <h3 class="text-lg font-bold mb-4">Data Pendidikan</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-4 py-2">Uraian</th>
                                <th class="px-4 py-2">Semester</th>
                                                                <th class="px-4 py-2">Satuan</th>
                                <th class="px-4 py-2">Volume</th>
                                <th class="px-4 py-2">AK</th>
                                <th class="px-4 py-2">Jumlah AK</th>
                                <th class="px-4 py-2">Keterangan</th>
                                <th class="px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                            <tr class="bg-white border-b">
                                <td class="px-4 py-2">{{ $item->uraian_kegiatan }}</td>
                                <td class="px-4 py-2">{{ $item->semester }}</td>
                                                                <td class="px-4 py-2">{{ $item->satuan_hasil }}</td>
                                <td class="px-4 py-2">{{ $item->volume }}</td>
                                <td class="px-4 py-2">{{ $item->angka_kredit }}</td>
                                <td class="px-4 py-2">{{ $item->jumlah_angka_kredit }}</td>
                                <td class="px-4 py-2">
                                    <div class="text-xs mb-2">{{ $item->keterangan }}</div>
                                    @if($item->buktis->count() > 0)
                                        <ul class="list-disc pl-4 text-xs">
                                            @foreach($item->buktis as $b)
                                                <li>
                                                    <a href="{{ $b->link_gdrive }}" target="_blank" class="text-indigo-600 hover:underline">{{ $b->deskripsi }}</a>
                                                    <form action="{{ route('bukti.destroy', $b->id) }}" method="POST" class="inline ml-1">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-500 font-bold" title="Hapus Bukti">&times;</button>
                                                    </form>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </td>
                                <td class="px-4 py-2">
                                    
                                    <div class="flex gap-2">
                                        <button type="button" onclick="openBuktiModal({{ $item->id }}, 'pendidikan')" class="text-blue-600 hover:text-blue-900 bg-blue-100 px-2 py-1 rounded text-xs">Tambah Bukti</button>
                                        <a href="{{ route('pendidikan.edit', $item->id) }}" class="inline-flex items-center px-2 py-1 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 focus:bg-yellow-600 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Edit
                                        </a>
                                        <form action="{{ route('pendidikan.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Tambah Bukti -->
    <div id="buktiModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Tambah Bukti</h3>
                <div class="mt-2 text-left">
                    <form id="buktiForm" action="{{ route('bukti.store') }}" method="POST">
                        @csrf
                        <input type="hidden" id="buktiable_id" name="buktiable_id" value="">
                        <input type="hidden" id="buktiable_type" name="buktiable_type" value="">
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <input type="text" name="deskripsi" class="mt-1 p-2 w-full border rounded-md" required placeholder="Misal: Sertifikat / Laporan">
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Link Google Drive</label>
                            <input type="url" name="link_gdrive" class="mt-1 p-2 w-full border rounded-md" required placeholder="https://drive.google.com/...">
                        </div>
                        
                        <div class="flex justify-between items-center mt-4">
                            <button type="button" onclick="closeBuktiModal()" class="text-gray-500 hover:text-gray-700">Batal</button>
                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Simpan Bukti</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function openBuktiModal(id, type) {
            document.getElementById('buktiable_id').value = id;
            document.getElementById('buktiable_type').value = type;
            document.getElementById('buktiModal').classList.remove('hidden');
        }
        function closeBuktiModal() {
            document.getElementById('buktiModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
