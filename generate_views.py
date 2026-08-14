import os

models = ['Pendidikan', 'Penelitian', 'Pengabdian', 'Penunjang']
base_path = '/home/andy/Documents/Pengajuan AK/BKD/dupak-app/resources/views'

template = """<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('{Model}') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <h3 class="text-lg font-bold mb-4">Tambah Data {Model}</h3>
                <form action="{{ route('{model_lower}.store') }}" method="POST" class="mb-8">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="uraian_kegiatan" value="Uraian Kegiatan" />
                            <x-text-input id="uraian_kegiatan" name="uraian_kegiatan" type="text" class="mt-1 block w-full" required />
                        </div>
                        <div>
                            <x-input-label for="tanggal" value="Tanggal" />
                            <x-text-input id="tanggal" name="tanggal" type="date" class="mt-1 block w-full" />
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

                <h3 class="text-lg font-bold mb-4">Data {Model}</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-4 py-2">Uraian</th>
                                <th class="px-4 py-2">Tanggal</th>
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
                                <td class="px-4 py-2">{{ $item->tanggal }}</td>
                                <td class="px-4 py-2">{{ $item->satuan_hasil }}</td>
                                <td class="px-4 py-2">{{ $item->volume }}</td>
                                <td class="px-4 py-2">{{ $item->angka_kredit }}</td>
                                <td class="px-4 py-2">{{ $item->jumlah_angka_kredit }}</td>
                                <td class="px-4 py-2">{{ $item->keterangan }}</td>
                                <td class="px-4 py-2">
                                    <form action="{{ route('{model_lower}.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
"""

for model in models:
    model_lower = model.lower()
    dir_path = os.path.join(base_path, model_lower)
    os.makedirs(dir_path, exist_ok=True)
    
    file_path = os.path.join(dir_path, "index.blade.php")
    content = template.replace('{Model}', model).replace('{model_lower}', model_lower)
    
    with open(file_path, 'w') as f:
        f.write(content)
    print(f"Created {model_lower}/index.blade.php")

# Create Rekap View
rekap_path = os.path.join(base_path, 'rekap')
os.makedirs(rekap_path, exist_ok=True)
with open(os.path.join(rekap_path, 'index.blade.php'), 'w') as f:
    f.write("""<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rekap DUPAK') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <h3 class="text-lg font-bold mb-4">Export ke Excel</h3>
                <p class="mb-4">Tekan tombol di bawah ini untuk memasukkan semua data yang telah diinput ke dalam template DUPAK_NOL KILO.xlsx.</p>
                <form action="{{ route('rekap.export') }}" method="POST">
                    @csrf
                    <x-primary-button>Generate Excel</x-primary-button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
""")
print("Created rekap/index.blade.php")
