<?php

namespace App\Livewire\Revision;

use App\Models\Berkas;
use App\Models\Revision as ModelsRevision;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Edit extends Component
{
    public $tanggalRevisi;
    public $batasTanggalRevisi;
    public $namaPengirim;
    public $catatanRevisi;

    public $statusFile = 'revision';

    public $berkasId;
    public $revisionId;

    public function rules(){
        return [
            'tanggalRevisi' => ['required'],
            'batasTanggalRevisi' => ['nullable'],
            'namaPengirim' => ['nullable','string','min:2','max:255'],
            'catatanRevisi' => ['required','string','min:2'],
        ];
    }

    public function edit(){
        $this->validate();

        $berkas = Berkas::findOrFail($this->berkasId);
        $user = auth()->user();

        $revision = ModelsRevision::findOrFail($this->revisionId);

        try{
            DB::beginTransaction();

            $berkas->update([
                'status_file' => $this->statusFile,
            ]);

            $revision->update([
                'berkas_id' => $this->berkasId,
                'mahasiswa_id' => $berkas->mahasiswa->id,
                'user_id' => $user->id,
                'date_revision' => $this->tanggalRevisi,
                'gathering_limit_date' => $this->batasTanggalRevisi,
                'note_revision' => $this->catatanRevisi,
                'provider_name' => $this->namaPengirim,
            ]);

            DB::commit();
        }catch(Exception $e){
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal.',
                'detail' => "revisi berkas gagal disunting.",
            ]);
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => "revisi berkas berhasil disunting.",
        ]);

        return redirect()->route('revision.index');
    }

    public function mount($id){
        $this->tanggalRevisi = Carbon::now()->format('Y-m-d\TH:i');
        $this->namaPengirim = auth()->user()->username;
        $this->berkasId = $id;
        $berkas = Berkas::findOrFail($this->berkasId);

        if($berkas){
            $revision = ModelsRevision::findOrFail($berkas->revision->id);
            $this->revisionId = $revision->id;
            $this->batasTanggalRevisi = $revision->gathering_limit_date;
            $this->catatanRevisi = $revision->note_revision;
        }
    }

    public function render()
    {
        return view('livewire.revision.edit');
    }
}
