<?php

namespace App\Livewire\Frontend\Service;

use App\Models\Berkas;
use App\Models\Mahasiswa;
use App\Models\Revision;
use App\Notifications\SendCodeDocument;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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
    public $getKategoriBerkas;

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

    public function openModal($id,$title, $key){
        if($key == 0){
            $this->getKategoriBerkas = 'proposal';
        }else if($key == 1){
            $this->getKategoriBerkas = 'hasil';
        }else{
            $this->getKategoriBerkas = 'tutup';
        }

        $this->mahasiswaId = $id;
        $this->namaBerkas = $title;
        $this->show = true;
    }

    public function closeModal(){
        $this->formReset();
    }

    public function updatedKategoriBerkas($category){
        Session::put('kategori-berkas', $category);
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
            'statusFile' => ['required', 'string', Rule::in(config('const.status_file'))],
            'catatanMahasiswa' => ['required', 'string', 'min:2', 'max:255'],
            'getKategoriBerkas' => ['required','string','min:2'],
        ]);

        try {
            DB::beginTransaction();

            $berkas = Berkas::where('mahasiswa_id', $this->mahasiswaId)
                ->where('name_file', $this->namaBerkas)
                ->where('category', $this->getKategoriBerkas)
                ->first();

            if($berkas){
                $berkas->update([
                    'mahasiswa_id' => $this->mahasiswaId,
                    'name_file' => $this->namaBerkas,
                    'note_mahasiswa' => $this->catatanMahasiswa,
                    'category' => $this->getKategoriBerkas,

                    'date_upload' => Carbon::now()->format('Y-m-d'),
                    'time_upload' => Carbon::now()->format('H:i:s'),
                    'status_file' => 'revised',
                    'type_document' => 'PDF',
                ]);

                if($this->uploadBerkas){
                    if($berkas->file){
                        File::delete(public_path('storage/' . $berkas->file));
                    }

                    $berkas->update([
                        'file' => $this->uploadBerkas->store('berkas-mahasiswa','public'),
                    ]);
                }

                Notification::send(auth()->user(), new SendCodeDocument($berkas->code_document,$this->namaBerkas));
            }else{
                $berkas = Berkas::create([
                    'mahasiswa_id' => $this->mahasiswaId,
                    'name_file' => $this->namaBerkas,
                    'note_mahasiswa' => $this->catatanMahasiswa,
                    'category' => $this->getKategoriBerkas,
                    'file' => $this->uploadBerkas->store('berkas-mahasiswa','public'),
                    'status_file' => $this->statusFile,

                    'date_upload' => Carbon::now()->format('Y-m-d'),
                    'time_upload' => Carbon::now()->format('H:i:s'),
                    'code_document' => code_document(),
                    'type_document' => 'PDF',
                ]);

                Notification::send(auth()->user(), new SendCodeDocument($berkas->code_document,$this->namaBerkas));
            }

            DB::commit();
        } catch (Exception $e) {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal.',
                'detail' => "Upload Berkas $this->kategoriBerkas",
            ]);

            $this->show = false;
            return redirect()->route('service-mahasiswa.upload-berkas');
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => "upload berkas $this->kategoriBerkas ditambah.",
        ]);

        $this->show = false;
        return redirect()->route('service-mahasiswa.upload-berkas');
    }

    public function mount(){

        $akun = auth()->user();
        $mahasiswa = Mahasiswa::where('email', $akun->email)->firstOrFail();

        if(Session::get('kategori-berkas')){
            $this->kategoriBerkas = Session::get('kategori-berkas');
        }

        if($mahasiswa){
            $this->mahasiswaId = $mahasiswa->id;
        }
    }

    public function render()
    {
        return view('livewire.frontend.service.upload-berkas');
    }
}
