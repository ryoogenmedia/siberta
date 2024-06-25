<?php

namespace App\Livewire\Frontend\Service;

use App\Models\Berkas;
use App\Models\Mahasiswa;
use App\Models\Revision;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class UploadBerkas extends Component
{

    use WithFileUploads;

    #[Title('Upload Berkas')]
    #[Layout('layouts.base-service')]

    public $show = false;
    public $statusFile ='pending';
    public $kategoriBerkas;
    public $berkas;
    public $mahasiswaId;
    public $catatanMahasiswa;
    public $uploadBerkas;
    public $namaBerkas;

    public Revision $revision;
    public $fileBerkas;
    public $typeBerkas;

    public function formResetInfoRevision(){
        $this->formReset('revision');
    }

    public function showRevision($revisionId){
        $berkas = Berkas::findOrFail($revisionId);

        if($berkas){
            $this->revision = $berkas->revision;
        }
    }

    public function checkFile($type){
        $mahasiswa = Mahasiswa::findOrFail($this->mahasiswaId);
        $berkas = Berkas::where('name_file', $type)->where('mahasiswa_id', $mahasiswa->id)->first();

        return $berkas;
    }

    public function kategoriBerkas()
    {
        $daftarBerkas = [];

        if ($this->kategoriBerkas && isset(config('const.name_file')[$this->kategoriBerkas])) {
            $daftarBerkas = config('const.name_file')[$this->kategoriBerkas];
        }

        return $daftarBerkas;
    }
    public $modalTitle = '' ;

    public function openModal($id,$title ){
        $this->mahasiswaId = $id;
        $this->show = true;
        $this->namaBerkas = $title;
    }

    public function closeModal(){
        $this->formReset();
    }

    public function updatedKategoriBerkas($category){
        $mahasiswa = Mahasiswa::findOrFail($this->mahasiswaId);
        $this->berkas = Berkas::query()
            ->where('mahasiswa_id', $mahasiswa->id)
            ->where('category', $category)
            ->get();
    }

    public function formReset(){
        $this->namaBerkas = null;
        $this->show = false;

    }
    public function save(){

        $this->validate([
            'uploadBerkas' => ['required', 'mimes:pdf'],
            'namaBerkas' => ['required', 'min:2', 'max:255'],
            'kategoriBerkas' => ['required','min:2','max:255', Rule::in(config('const.category_document'))],
            'statusFile' => ['required', 'string', Rule::in(config('const.status_file'))],
            'catatanMahasiswa' => ['required', 'string', 'min:2', 'max:255']
        ]);

        try {
            DB::beginTransaction();

            $filePath = $this->uploadBerkas->store('berkas-mahasiswa', 'public');

            Berkas::create([
                'mahasiswa_id' => $this->mahasiswaId,
                'type_document' => 'PDF',
                'name_file' => $this->namaBerkas,
                'note_mahasiswa' => $this->catatanMahasiswa,
                'date_upload' => Carbon::now()->format('Y-m-d'),
                'time_upload' => Carbon::now()->format('H:i:s'),
                'category' => $this->kategoriBerkas,
                'file' => $filePath,
                'status_file' => $this->statusFile,
                'code_document' => code_document(),
            ]);

            DB::commit();
            session()->flash('alert', [
                'type' => 'success',
                'message' => 'Berhasil.',
                'detail' => "upload berkas $this->kategoriBerkas ditambah.",
            ]);

            $this->formReset();

        } catch (\Exception $e) {
            DB::rollBack();

            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal.',
                'detail' => "Upload Berkas $this->kategoriBerkas",
            ]);

            return back();
        }
    }

    public function mount(){

        $akun = auth()->user();
        $mahasiswa = Mahasiswa::where('email', $akun->email)->firstOrFail();

        if($mahasiswa){
            $this->mahasiswaId = $mahasiswa->id;
        }
    }

    public function render()
    {
        return view('livewire.frontend.service.upload-berkas');
    }
}
