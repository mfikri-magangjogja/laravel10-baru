<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kaprodi;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KaprodiController extends Controller
{
    public function data($id)
    {
        $kaprodi = Kaprodi::findOrFail($id);

        return view('profile/infoakun', compact('kaprodi'));
    }

    
    public function indexdosen()
    {
        $dosen = dosen::get();
        return view('kaprodidosenindex', compact('dosen'));
    }


    public function createDosen()
    {
        $user = User::select('id')->where('role', 'dosen')->get();
        return view('kaprodidosencreate', compact('user'));
    }


    public function storeDosen(Request $request)
    {

        Dosen::create([
            'id_user' => $request->input('id_user'),
            'kode_dosen' => $request->input('kode_dosen'),
            'nip' => $request->input('nip'),
            'nama' => $request->input('nama'),
        ]);


        return redirect()->route('kaprodi.dosen.index')->with('success', 'Dosen berhasil ditambah.');
    }

    public function editDosen($id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('kaprodidosenedit', compact('dosen'));
    }



    public function updateDosen(Request $request, $id)
    {
        $request->validate([
            'kode_dosen' => 'required|integer',
            'nip' => 'required|integer',
            'nama' => 'required|string|max:100',
        ]);

        $dosen = Dosen::findOrFail($id);
        $dosen->update($request->all());

        return redirect()->route('kaprodi.dosen.index')->with('success', 'Dosen berhasil diperbarui.');
    }


    public function destroyDosen(Dosen $id)
    {
        $dosen = Dosen::findOrFail($id);
        $dosen->delete();
        return redirect()->route('kaprodi.dosen.index')->with('success', 'Dosen berhasil dihapus.');
    }


    public function indexKelas()
    {
        $kelas = Kelas::all();
        return view('kaprodikelasindex', compact('kelas'));
    }

    public function createKelas()
    {
        return view('kaprodikelascreate');
    }

    public function storeKelas(Request $request)
    {
        Kelas::create([
            'nama' => $request->input('nama'),
            'kapasitas' => $request->input('kapasitas'),

        ]);

        return redirect()->route('kaprodi.kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function editKelas($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('kaprodikelasedit', compact('kelas'));
    }

    public function updateKelas(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:50',
            'kapasitas' => 'required|integer|min:1',
        ]);

        $kelas->update($request->only(['nama', 'kapasitas']));

        return redirect()->route('kaprodi.kelas.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroyKelas($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('kaprodi.kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }
    public function indexplot(Request $request)
    {
        // Mengambil data kelas
        $kelas = Kelas::all();

        // Mengambil ID kelas dari request atau parameter
        // Mengambil dosen yang sesuai dengan ID kelas
        $dosenByKelas = [];
        foreach ($kelas as $kelasItem) {
            $dosenByKelas[$kelasItem->id] = Dosen::where('kelas_id', $kelasItem->id)->get();
        }
        $mahasiswaByKelas = [];
        foreach ($kelas as $kelasItem) {
            $mahasiswaByKelas[$kelasItem->id] = Mahasiswa::where('kelas_id', $kelasItem->id)->get();
        }

        return view('kaprodiplotindex', compact('kelas', 'dosenByKelas', 'mahasiswaByKelas'));
    }


    public function plotDosenForm($id)
    {
        // Ambil data kelas berdasarkan ID
        $kelas = Kelas::findOrFail($id);

        // Ambil semua dosen
        $dosen = Dosen::whereNull('kelas_id')->get();

        return view('kaprodiplotdosen', compact('kelas', 'dosen'));
    }

    public function plotDosen(Request $request)
{
    $request->validate([
        'dosen_id' => 'required|exists:t_dosen,id',
        'kelas_id' => 'required|exists:t_kelas,id',
    ]);

    // Temukan dosen berdasarkan ID
    $dosen = Dosen::findOrFail($request->input('dosen_id'));

    // Temukan kelas yang dituju
    $kelas = Kelas::findOrFail($request->input('kelas_id'));

    // Periksa apakah kelas sudah memiliki dosen
    $kelasDenganDosen = Dosen::where('kelas_id', $kelas->id)->first();

    if ($kelasDenganDosen) {
        return redirect()->route('kaprodi.plot.index')->with('error', 'Kelas ini sudah memiliki dosen.');
    }

    // Perbarui kelas dosen
    $dosen->update([
        'kelas_id' => $kelas->id
    ]);

    return redirect()->route('kaprodi.plot.index')->with('success', 'Dosen berhasil dipindahkan ke kelas.');
}


    public function destroyKelasDosen($id)
    {
        // Temukan dosen berdasarkan ID
        $dosen = Dosen::findOrFail($id);

        // Set `id_kelas` menjadi null
        $dosen->update(['kelas_id' => null]);

        // Redirect atau berikan feedback
        return redirect()->route('kaprodi.plot.index')->with('success', 'Kelas dosen berhasil dihapus.');
    }



    public function plotMahasiswaForm($id)
    {
        // Ambil data kelas berdasarkan ID
        $kelas = Kelas::findOrFail($id);

        // Ambil semua dosen
        $mahasiswa = Mahasiswa::whereNull('kelas_id')->get();;

        return view('kaprodiplotmahasiswa', compact('kelas', 'mahasiswa'));
    }

    public function plotMahasiswa(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:t_mahasiswa,id',
            'kelas_id' => 'required|exists:t_kelas,id',
        ]);
    
        // Temukan mahasiswa berdasarkan ID
        $mahasiswa = Mahasiswa::findOrFail($request->input('mahasiswa_id'));
    
        // Temukan kelas yang dituju
        $kelas = Kelas::findOrFail($request->input('kelas_id'));
    
        // Hitung jumlah mahasiswa di kelas yang dituju
        $jumlahMahasiswaDiKelas = Mahasiswa::where('kelas_id', $kelas->id)->count();
    
        // Periksa apakah kapasitas kelas mencukupi
        if ($jumlahMahasiswaDiKelas >= $kelas->kapasitas) {
            return redirect()->route('kaprodi.plot.index')->with('error', 'Kelas ini sudah penuh.');
        }
    
        // Jika mahasiswa sebelumnya ada di kelas lain, kurangi jumlah mahasiswa dari kelas lama
        if ($mahasiswa->kelas_id) {
            $kelasLama = Kelas::find($mahasiswa->kelas_id);
            if ($kelasLama) {
                $jumlahMahasiswaDiKelasLama = Mahasiswa::where('kelas_id', $kelasLama->id)->count();
                // Jika jumlah mahasiswa di kelas lama sudah 1, maka tidak perlu tindakan lebih lanjut
                if ($jumlahMahasiswaDiKelasLama <= 1) {
                    // Tidak melakukan pengurangan lebih lanjut jika hanya ada satu mahasiswa di kelas lama
                }
            }
        }
    
        // Perbarui kelas mahasiswa
        $mahasiswa->update([
            'kelas_id' => $kelas->id
        ]);
    
        return redirect()->route('kaprodi.plot.index', $kelas->id)->with('success', 'Mahasiswa berhasil diperbarui.');
    }
    


    public function destroyKelasMahasiswa($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $mahasiswa->update(['kelas_id' => null]);

        return redirect()->route('kaprodi.plot.index')->with('success', 'Kelas dosen berhasil dihapus.');
    }
}
