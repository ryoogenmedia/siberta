<?php

namespace App\Livewire\Berkas\Hasil;

use App\Models\Berkas;
use App\Models\Revision as ModelsRevision;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Revision extends Component
{
    public $tanggalRevisi;
    public $batasTanggalRevisi;
    public $namaPengirim;
    public $catatanRevisi;

    public $kategori = 'hasil';
    public $statusFile = 'revision';

    public $berkasId;

    public function rules(){
        return [
            'tanggalRevisi' => ['required'],
            'batasTanggalRevisi' => ['nullable'],
            'namaPengirim' => ['nullable','string','min:2','max:255'],
            'catatanRevisi' => ['required','string','min:2'],
        ];
    }

    public function save(){
        $this->validate();

        $berkas = Berkas::findOrFail($this->berkasId);
        $user = auth()->user();

        try{
            DB::beginTransaction();

            $berkas->update([
                'status_file' => $this->statusFile,
            ]);

            ModelsRevision::create([
                'berkas_id' => $berkas->id,
                'mahasiswa_id' => $berkas->mahasiswa->id,
                'user_id' => $user->id,
                'date_revision' => $this->tanggalRevisi,
                'gathering_limit_date' => $this->batasTanggalRevisi ?? null,
                'note_revision' => $this->catatanRevisi,
                'provider_name' => $this->namaPengirim,
                'category' => $this->kategori,
            ]);

            DB::commit();
        }catch(Exception $e){
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal.',
                'detail' => "revisi berkas gagal ditambah.",
            ]);
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => "revisi berkas berhasil ditambah.",
        ]);

        return redirect()->route('berkas.hasil.index');
    }

    public function mount($id){
        $this->tanggalRevisi = Carbon::now()->format('Y-m-d\TH:i');
        $this->namaPengirim = auth()->user()->username;

        $this->berkasId = $id;
    }

    public function render()
    {
        return view('livewire.berkas.hasil.revision');
    }
}
