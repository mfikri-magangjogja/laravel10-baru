
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <a href="{{ route('kaprodi.dosen.create') }}" class="btn btn-primary">Tambah</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">ID Dosen</th>
                            <th scope="col">ID User</th>
                            <th scope="col">ID Kelas</th>
                            <th scope="col">Kode Dosen</th>
                            <th scope="col">NIP</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{ $i = 1 }}
                        @foreach ($dosen as $d)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td>{{ $d->id }}</td>
                            <td>{{ $d->id_user }}</td>
                            <td>{{ $d->kelas_id }}</td>
                            <td>{{ $d->kode_dosen }}</td>
                            <td>{{ $d->nip }}</td>
                            <td>{{ $d->nama }}</td>
                            <td>
                                <a href="{{ route('kaprodi.dosen.edit', $d->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                {{-- <a href="{{ route('kaprodi.dosen.destroy', $d->id) }}" class="btn btn-danger btn-sm">Hapus</a> --}}
            
                                <form action="{{ route('kaprodi.dosen.destroy', $d->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>


