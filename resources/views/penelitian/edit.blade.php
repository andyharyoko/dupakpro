<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Penelitian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('penelitian.update', $penelitian->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <x-input-label for="uraian_kegiatan" :value="__('Uraian Kegiatan')" />
                        <x-text-input id="uraian_kegiatan" class="block mt-1 w-full" type="text" name="uraian_kegiatan" :value="old('uraian_kegiatan', $penelitian->uraian_kegiatan)" required />
                    </div>

                    <div>
                        <x-input-label for="semester" :value="__('Semester')" />
                        <select name="semester" id="semester" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                            @php
                                $semesters = [];
                                for ($i = 2025; $i >= 2020; $i--) {
                                    $semesters[] = "TA " . $i . "/" . ($i+1) . " Genap";
                                    $semesters[] = "TA " . $i . "/" . ($i+1) . " Ganjil";
                                }
                            @endphp
                            @foreach($semesters as $sem)
                                <option value="{{ $sem }}" {{ old('semester', $penelitian->semester) == $sem ? 'selected' : '' }}>{{ $sem }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="volume" :value="__('Volume')" />
                            <x-text-input id="volume" class="block mt-1 w-full" type="number" step="0.01" name="volume" :value="old('volume', $penelitian->volume)" required />
                        </div>
                        <div>
                            <x-input-label for="angka_kredit" :value="__('Angka Kredit (AK)')" />
                            <x-text-input id="angka_kredit" class="block mt-1 w-full" type="number" step="0.01" name="angka_kredit" :value="old('angka_kredit', $penelitian->angka_kredit)" required />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4 gap-2">
                        <a href="{{ route('penelitian.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                            Batal
                        </a>
                        <x-primary-button>
                            {{ __('Simpan Perubahan') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
