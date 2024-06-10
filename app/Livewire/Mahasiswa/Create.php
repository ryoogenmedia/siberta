<?php

namespace App\Livewire\Mahasiswa;

use App\Models\Mahasiswa;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Create extends Component
{
    public $namaMahasiswa;
    public $nim;
    public $nomorPonsel;
    public $email;
    public $tahunMasuk;
    public $programStudi;
    public $alamat;

    public function rules(){
        return [
            'namaMahasiswa' => ['required','string','min:2','max:255'],
            'nim' => ['required','string','min:2','unique:mahasiswa,nim'],
            'nomorPonsel' => ['required','string','min:2','unique:mahasiswa,phone'],
            'email' => ['required','string','min:2','max:255','email','unique:mahasiswa,email'],
            'tahunMasuk' => ['required','string','min:2'],
            'programStudi' => ['required','string','min:2','max:255'],
            'alamat' => ['nullable','string','min:2'],
        ];
    }

    public function save(){
        $this->validate();

        try{
            DB::beginTransaction();

            Mahasiswa::create([
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

    public function render()
    {
        return view('livewire.mahasiswa.create');
    }
}
