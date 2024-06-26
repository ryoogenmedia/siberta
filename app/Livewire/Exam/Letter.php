<?php

namespace App\Livewire\Exam;

use App\Livewire\Traits\DataTable\WithBulkActions;
use App\Livewire\Traits\DataTable\WithCachedRows;
use App\Livewire\Traits\DataTable\WithPerPagePagination;
use App\Livewire\Traits\DataTable\WithSorting;
use App\Models\Berkas;
use App\Models\Mahasiswa;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

class Letter extends Component
{
    use WithBulkActions;
    use WithPerPagePagination;
    use WithCachedRows;
    use WithSorting;
    use WithFileUploads;

    public $show = false;
    public $suratUjian;
    public $berkasId;
    public $kategoriBerkas;
    public $mahasiswaId;

    public $filters = [
        'search' => '',
        'nim' => '',
        'program_studi' => '',
        'nomor_ponsel' => '',
        'tahun_masuk' => '',
    ];

    public function deleteSelected(){
        $mahasiswa = Mahasiswa::whereIn('id', $this->selected)->get();
        $deleteCount = $mahasiswa->count();

        foreach ($mahasiswa as $data) {
            $data->delete();
        }

        $this->reset();

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => "$deleteCount data mahasiswa berhasil dihapus.",
        ]);

        return redirect()->route('mahasiswa.index');
    }

    public function openModal($id){
        $this->mahasiswaId = $id;
        $this->show = true;
    }

    public function closeModal(){
        $this->show = false;
    }

    public function checkExamLetter($id, $category){
        $berkas = Berkas::where('mahasiswa_id', $id)->where('category', $category)->first();
        return $berkas->exam_letter ?? null;
    }

    public function  save(){
        $this->validate([
            'suratUjian' => ['required','mimes:png,jpg,pdf'],
            'kategoriBerkas' => ['required','string','min:2','max:255', Rule::in(config('const.category_document'))]
        ]);

        $berkas = Berkas::where('mahasiswa_id', $this->mahasiswaId)
            ->where('category',  $this->kategoriBerkas)->get();

        $berkasFirst = Berkas::where('mahasiswa_id', $this->mahasiswaId)
            ->where('category', $this->kategoriBerkas)
            ->first();

        foreach($berkas as $data){
            if($data->status_file != 'approve'){
                session()->flash('alert', [
                    'type' => 'warning',
                    'message' => 'Bahaya.',
                    'detail' => "Berkas $this->kategoriBerkas belum tuntas / belum di setujui",
                ]);

                return redirect()->route('exam.letter');
            }

            if(in_array($data->name_file, config('const.name_file'))){
                session()->flash('alert', [
                    'type' => 'warning',
                    'message' => 'Bahaya.',
                    'detail' => "Berkas $this->kategoriberkas belum lengkap / belum memenuhi syarat",
                ]);

                return redirect()->route('exam.letter');
            }
        }

        try {
            DB::beginTransaction();

            if($this->suratUjian){
                if($berkasFirst->exam_letter){
                    File::delete(public_path('storage/' . $berkasFirst->exam_letter));
                }

                $berkasFirst->update([
                    'exam_letter' => $this->suratUjian->store('surat-ujian', 'public'),
                ]);
            }

            foreach($berkas as $data){
                $data->update([
                    'exam_letter' => $berkasFirst->exam_letter,
                ]);
            }

            DB::commit();
        } catch (Exception $e) {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal.',
                'detail' => "Upload surat ujian gagal!",
            ]);

            return back();
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => "upload surat ujian berhasil ditambah.",
        ]);

        $this->show = false;
        return redirect()->route('exam.letter');
    }

    #[Computed()]
    public function tahunMasuk(){
        return Mahasiswa::query()
            ->select('entry_year')
            ->groupBy('entry_year')
            ->distinct()
            ->get();
    }

    #[Computed()]
    public function rows(){
        $query = Mahasiswa::query()
            ->when(!$this->sorts, fn ($query) => $query->first())
            ->when($this->filters['nim'], fn($query,$nim) => $query->where('nim', $nim))
            ->when($this->filters['program_studi'], fn($query, $programStudi) => $query->where('program_studi', $programStudi))
            ->when($this->filters['tahun_masuk'], fn($query, $tahunMasuk) => $query->where('entry_year', $tahunMasuk))
            ->when($this->filters['search'], function ($query, $search) {
                $query->whereAny(['name','nim','program_studi','email','phone','address','entry_year'], 'LIKE', "%$search%");
            });

        return $this->applyPagination($query);
    }

    #[Computed()]
    public function allData()
    {
        return Mahasiswa::all();
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
        return view('livewire.exam.letter');
    }
}
