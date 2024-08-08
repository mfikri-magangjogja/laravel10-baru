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
                    <form method="POST" action="{{ route('kaprodi.dosen.update', $dosen->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="dosen_id">ID Dosen</label>
                            <input type="text" class="form-control" id="dosen_id" name="dosen_id" value="{{ $dosen->id }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="user_id">ID User</label>
                            <input type="text" class="form-control" id="user_id" name="user_id" value="{{ $dosen->id_user }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="kode_dosen">Kode Dosen</label>
                            <input type="text" class="form-control" id="kode_dosen" name="kode_dosen" value="{{ $dosen->kode_dosen }}">
                        </div>
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip" value="{{ $dosen->nip }}">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ $dosen->nama }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

