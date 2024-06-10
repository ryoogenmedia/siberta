<?php

namespace App\Livewire\Mahasiswa;

use App\Models\Mahasiswa;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Edit extends Component
{
    public $namaMahasiswa;
    public $nim;
    public $nomorPonsel;
    public $email;
    public $tahunMasuk;
    public $programStudi;
    public $alamat;

    public $mahasiswaId;

    public function rules(){
        return [
            'namaMahasiswa' => ['required','string','min:2','max:255'],
            'nim' => ['required','string','min:2','unique:mahasiswa,nim,' . $this->mahasiswaId],
            'nomorPonsel' => ['required','string','min:2','unique:mahasiswa,phone,' . $this->mahasiswaId],
            'email' => ['required','string','min:2','max:255','email','unique:mahasiswa,email,' . $this->mahasiswaId],
            'tahunMasuk' => ['required','string','min:2'],
            'programStudi' => ['required','string','min:2','max:255'],
            'alamat' => ['nullable','string','min:2'],
        ];
    }

    public function edit(){
        $this->validate();

        $mahasiswa = Mahasiswa::findOrFail($this->mahasiswaId);

        try{
            DB::beginTransaction();

            $mahasiswa->update([
                'name' => $this->namaMahasiswa,
                'nim' => $this->nim,
                'phone' => $this->nomorPonsel,
                'email' => $this->email,
                'entry_year' => $this->tahunMasuk,
                'program_studi' => $this->programStudi,
                'address' => $this->alamat,
            ]);

            DB::commit();
        }catch(Exception $e){
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal.',
                'detail' => "data mahasiswa gagal ditambah.",
            ]);
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => "data mahasiswa berhasil ditambah.",
        ]);

        return redirect()->route('mahasiswa.index');
    }

    public function mount($id){
        $mahasiswa = Mahasiswa::findOrFail($id);

        if($mahasiswa){
            $this->mahasiswaId = $mahasiswa->id;
            $this->namaMahasiswa = $mahasiswa->name;
            $this->nomorPonsel = $mahasiswa->phone;
            $this->email = $mahasiswa->email;
            $this->nim = $mahasiswa->nim;
            $this->programStudi = $mahasiswa->program_studi;
            $this->tahunMasuk = $mahasiswa->entry_year;
            $this->alamat = $mahasiswa->address;
        }
    }

    public function render()
    {
        return view('livewire.mahasiswa.edit');
    }
}
