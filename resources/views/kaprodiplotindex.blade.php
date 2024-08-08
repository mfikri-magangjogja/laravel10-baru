<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('kaprodi.plot.dosen') }}" class="btn btn-warning btn-sm">Plot Dosen</a>
                    <a href="{{ route('kaprodi.plot.mahasiswa') }}" class="btn btn-warning btn-sm">Plot Mahasiswa</a>
                </div>
            </div>
        </div>
    </div>

    
    @foreach ($kelas as $k)
        <div class="py-12">
            
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-white">
                    <p class="text-white">Kelas: {{ $k->nama }}</p>
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
                            @foreach ($dosenByKelas[$k->id] as $dosen)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $dosen->id }}</td>
                                    <td>{{ $dosen->id_user }}</td>
                                    <td>{{ $dosen->kelas_id }}</td>
                                    <td>{{ $dosen->kode_dosen }}</td>
                                    <td>{{ $dosen->nip }}</td>
                                    <td>{{ $dosen->nama }}</td>
                                    <td>
                                        <form action="{{ route('kaprodi.dosen.destroy', $dosen->id) }}" method="POST"
                                            style="display:inline;">
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
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg  text-white">
                    <table class="table">
                        <thead>
                            <tr>
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
                            @foreach ($mahasiswaByKelas[$k->id] as $mahasiswa)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $mahasiswa->id }}</td>
                                    <td>{{ $mahasiswa->id_user }}</td>
                                    <td>{{ $mahasiswa->kelas_id }}</td>
                                    <td>{{ $mahasiswa->nama }}</td>
                                    <td>{{ $mahasiswa->nim }}</td>
                                    <td>{{ $mahasiswa->tempat_lahir }}</td>
                                    <td>{{ $mahasiswa->tanggal_lahir }}</td>
                                    <td>
                                        <form action="{{ route('kaprodi.mahasiswa.destroy', $mahasiswa->id) }}" method="POST"
                                            style="display:inline;">
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
    @endforeach
</x-app-layout>
