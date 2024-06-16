<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use Illuminate\Http\Request;

class LacakBerkasController extends Controller
{
    public function lacak(Request $request){
        $idBerkas = $request->input('idBerkas');

        $request->validate([
            'idBerkas' => ['required','string','min:2','max:8']
        ]);

        $berkas = Berkas::where('code_document', $idBerkas)->first();

        if($berkas){
            session()->flash('alert', [
                'type' => 'success',
                'message' => 'Berhasil.',
                'detail' => "Berkas ditemukan berdasarkan id berkas anda.",
            ]);

            return redirect()->route('service-mahasiswa.lihat-berkas', $idBerkas);
        }

        session()->flash('alert', [
            'type' => 'danger',
            'message' => 'Gagal.',
            'detail' => "ID Berkas tidak cocok dengan data kami, tidak ada berkas!",
        ]);

        return back();
    }
}
