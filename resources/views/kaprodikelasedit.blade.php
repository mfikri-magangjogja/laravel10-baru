
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container">
                    <form method="POST" action="{{ route('kaprodi.kelas.update', $kelas->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="kelas_id">ID Kelas</label>
                            <input type="text" class="form-control" id="kelas_id" name="kelas_id" value="{{ $kelas->id }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ $kelas->nama }}">
                        </div>
                        <div class="form-group">
                            <label for="kapasitas">Kapasitas</label>
                            <input type="text" class="form-control" id="kapasitas" name="kapasitas" value="{{ $kelas->kapasitas }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
