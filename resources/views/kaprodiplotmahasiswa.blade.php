<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('kaprodi.mahasiswa.update.kelas') }}" method="POST">
                    @csrf
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">No</th>
                                <th scope="col">ID Mahasiswa</th>
                                <th scope="col">ID User</th>
                                <th scope="col">ID Kelas</th>
                                <th scope="col">Nama</th>
                                <th scope="col">NIM</th>
                                <th scope="col">Tempat Lahir</th>
                                <th scope="col">Tanggal Lahir</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{ $i = 1 }}
                            @foreach ($mahasiswa as $m)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="mahasiswa_ids[]" value="{{ $m->id }}">
                                    </td>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $m->id }}</td>
                                    <td>{{ $m->id_user }}</td>
                                    <td>{{ $m->kelas_id }}</td>
                                    <td>{{ $m->nama }}</td>
                                    <td>{{ $m->nim }}</td>
                                    <td>{{ $m->tempat_lahir }}</td>
                                    <td>{{ $m->tanggal_lahir }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <!-- Input untuk ID Kelas -->
                    <div class="form-group">
                        <label for="id_kelas">Kelas ID</label>
                        <select class="form-select" aria-label="Default select example" name="id_kelas" id="id_kelas">
                            <option selected>Pilih ID Kelas</option>
                            @foreach ($kelas as $d)
                                <option value="{{ $d->id }}">{{ $d->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Tombol Simpan -->
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
