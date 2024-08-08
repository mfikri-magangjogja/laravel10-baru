<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Mahasiswa ke Kelas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('kaprodi.plot.save.mahasiswa') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="kelas_id" class="block text-gray-700">ID Kelas</label>
                            <input type="text" name="kelas_id" id="kelas_id" value="{{ $kelas->id }}" readonly class="form-input mt-1 block w-full">
                        </div>
                        
                        <div class="mb-4">
                            <label for="mahasiswa_id" class="block text-gray-700">Pilih Dosen</label>
                            <select name="mahasiswa_id" id="mahasiswa_id" class="form-select mt-1 block w-full">
                                @foreach ($mahasiswa as $m)
                                    <option value="{{ $m->id }}">{{ $m->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
