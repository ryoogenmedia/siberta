<?php

namespace App\Livewire\Revision\Hasil;

use App\Livewire\Traits\DataTable\WithBulkActions;
use App\Livewire\Traits\DataTable\WithCachedRows;
use App\Livewire\Traits\DataTable\WithPerPagePagination;
use App\Livewire\Traits\DataTable\WithSorting;
use App\Models\Berkas;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Component;
use ZipArchive;

class Index extends Component
{
    use WithBulkActions;
    use WithPerPagePagination;
    use WithCachedRows;
    use WithSorting;

    public $filters = [
        'search' => '',
        'tipe_dokumen' => '',
        'status_file' => '',
        'tanggal_awal' => '',
        'tanggal_akhir' => '',
        'program_studi' => '',
        'nama_file' => '',
        'nim' => '',
    ];

    public function approve($id){
        $berkas = Berkas::findOrFail($id);

        $berkas->status_file = 'approve';
        $berkas->save();

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => "Berkas mahasiswa telah di setujui",
        ]);

        return back();
    }

    public function unRevision($id){
        $berkas = Berkas::findOrFail($id);

        $berkas->status_file = 'pending';
        $berkas->revision->delete();

        $berkas->save();

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => "Berkas mahasiswa batal di revisi",
        ]);

        return back();
    }

    public function downloadFile($id){
        $berkas = Berkas::findOrFail($id);

        if($berkas->file && Storage::disk('public')->exists($berkas->file)){
            $zip = new ZipArchive;
            $fileName = '[ ' . $berkas->mahasiswa->name . ' ]-' . $berkas->name_file . '.zip';
            $zipPath = storage_path('app/public/' . $fileName);

            if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {

                $berkasPath = storage_path('app/public/' . $berkas->file);
                if (file_exists($berkasPath)) {
                    $extension = pathinfo($berkasPath, PATHINFO_EXTENSION);
                    $fileInZip = '[ ' . $berkas->mahasiswa->name . ' ]-' . $berkas->name_file . '.' . $extension;
                    $zip->addFile($berkasPath, $fileInZip);
                }

                $zip->close();

                return response()->download($zipPath)->deleteFileAfterSend(true);
            }else{
                session()->flash('alert', [
                    'type' => 'danger',
                    'message' => 'Gagal.',
                    'detail' => "file berkas mahasiswa tidak ditemukan.",
                ]);

                return back();
            }
        }
    }

    #[Computed()]
    public function rows(){
        $query = Berkas::where('status_file','revision')
            ->when(!$this->sorts, fn ($query) => $query->first())
            ->when($this->filters['tipe_dokumen'], function($query, $type){
                $query->where('category','hasil')->where('status_file', 'revision')->where('type_document', $type);
            })
            ->when($this->filters['status_file'], function($query, $status){
                $query->where('category','hasil')->where('status_file', 'revision')->where('status_file', $status);
            })
            ->when($this->filters['tanggal_awal'], function ($query, $tanggalAwal) {
                $query->where('category','hasil')->where('status_file', 'revision')->whereHas('revision', function($query) use ($tanggalAwal){
                    $query->where('date_revision', '>=', $tanggalAwal);
                });
            })
            ->when($this->filters['tanggal_akhir'], function ($query, $tanggalAkhir) {
                $query->where('category','hasil')->where('status_file', 'revision')->whereHas('revision', function($query) use ($tanggalAkhir){
                    $query->where('date_revision', '<=', $tanggalAkhir);
                });
            })
            ->when($this->filters['nama_file'], function($query, $namaFile){
                $query->where('category','hasil')->where('status_file', 'revision')->where('name_file', $namaFile);
            })
            ->when($this->filters['nim'], function($query, $nim){
                $query->where('category','hasil')->where('status_file', 'revision')->whereHas('mahasiswa', function($query) use ($nim){
                    $query->where('nim', $nim);
                });
            })
            ->when($this->filters['program_studi'], function($query, $programStudi){
                $query->where('category','hasil')->where('status_file', 'revision')->whereHas('mahasiswa', function($query) use ($programStudi){
                    $query->where('program_studi', $programStudi);
                });
            })
            ->when($this->filters['search'], function ($query, $search) {
                $query->where('category','hasil')->where('status_file', 'revision')->whereHas('mahasiswa', function($query) use ($search){
                    $query->whereAny(['name','nim','program_studi'], 'LIKE', "%$search%");
                })->orWhereAny(['name_file','type_document','status_file','date_upload','time_upload','note_mahasiswa'], 'LIKE', "%$search%");
            })->where('category','hasil')->where('status_file', 'revision');

        return $this->applyPagination($query);
    }

    #[Computed()]
    public function typeDocument(){
        return Berkas::select('type_document')
            ->orderBy('type_document')
            ->distinct()->get();
    }

    #[Computed()]
    public function allData()
    {
        return Berkas::where('status_file','revision')->get();
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function render()
    {
        return view('livewire.revision.hasil.index');
    }
}
