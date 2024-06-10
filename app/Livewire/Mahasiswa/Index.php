<?php

namespace App\Livewire\Mahasiswa;

use App\Livewire\Traits\DataTable\WithBulkActions;
use App\Livewire\Traits\DataTable\WithCachedRows;
use App\Livewire\Traits\DataTable\WithPerPagePagination;
use App\Livewire\Traits\DataTable\WithSorting;
use App\Models\Mahasiswa;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    use WithBulkActions;
    use WithPerPagePagination;
    use WithCachedRows;
    use WithSorting;

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
        return view('livewire.mahasiswa.index');
    }
}
