<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('kaprodi.dosen.update.kelas') }}" method="POST">
                    @csrf
                    <table class="table text-white">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                               <th scope="col">No</th>
                               <th scope="col">ID Dosen</th>
                               <th scope="col">ID User</th>
                               <th scope="col">Kode Dosen</th>
                               <th scope="col">NIP</th>
                               <th scope="col">Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{ $i = 1 }}
                            @foreach ($dosen as $d)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="dosen_ids[]" value="{{ $d->id }}">
                                    </td>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $d->id }}</td>
                                    <td>{{ $d->id_user }}</td>
                                    <td>{{ $d->kode_dosen }}</td>
                                    <td>{{ $d->nip }}</td>
                                    <td>{{ $d->nama }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <!-- Input untuk ID Kelas -->
                    <div class="form-group ">
                        <label class="text-white" for="id_kelas">Kelass</label>
                        <select class="form-select " aria-label="Default select example" name="id_kelas" id="id_kelas">
                            <option selected>Pilih ID Kelas</option>
                            @foreach ($kelas as $d)
                                <option value="{{ $d->id }}">{{ $d->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Tombol Simpan -->
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary text-white">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
