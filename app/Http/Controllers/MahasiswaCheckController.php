<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Otp;
use App\Models\User;
use App\Notifications\SendCodeOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Notification;

class MahasiswaCheckController extends Controller
{
    public function checkMahasiswa(){
        return view('auth.frontend.check-email');
    }

    public function checkEmail(Request $request){

        $request->validate([
            'email' => ['string','email','min:2','max:255'],
        ]);

        $email = $request->input('email');

        $mahasiswa = Mahasiswa::where('email', $email)->first();

        if($mahasiswa && $mahasiswa->akun()){
            session()->flash('alert', [
                'type' => 'success',
                'message' => 'Mahasiswa Ditemukan.',
                'detail' => "Silahkan masukkan kode otp yang dikirim lewat email anda!",
            ]);

            $akun = User::where('email', $mahasiswa->email)->firstOrFail();

            $otp = Otp::create([
                'user_id' => $akun->id,
                'code_otp' => otp_code(),
                'date_active' => Date::now()->addMinute(5),
            ]);

            $code = $otp->code_otp;

            Notification::send($akun, new SendCodeOtp($code));

            return redirect()->route('otp.view', $mahasiswa->id);
        }

        session()->flash('alert', [
            'type' => 'danger',
            'message' => 'Mahasiswa Tidak Ditemukan.',
            'detail' => "Email yang anda gunakan tidak terdapat pada aplikasi kami!",
        ]);

        return back();
    }

    public function OtpView(Mahasiswa $mahasiswa){
        return view('auth.frontend.check-otp', [
            'mahasiswa' => $mahasiswa
        ]);
    }

    public function OtpCheck(Request $request){
        $mahasiswaId = $request->input('mahasiswaId');
        $codeOtp = $request->input('otp');

        $request->validate([
            'otp' => ['string','min:6','max:6'],
        ]);

        $mahasiswa = Mahasiswa::findOrFail($mahasiswaId);
        $akun = User::where('email', $mahasiswa->email)->firstOrFail();
        $otp = Otp::where('code_otp', $codeOtp)->first();
        $check = $akun->isActiveOtp();

        if($check && $otp){
            session()->flash('alert', [
                'type' => 'success',
                'message' => 'Berhasil.',
                'detail' => "Kode OTP Benar, anda sekarang dapat mengajukan berkas!",
            ]);

            $otp->delete();
            Auth::login($akun);

            return redirect()->route('service-mahasiswa.upload-berkas');
        }else{
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal.',
                'detail' => "Kode OTP Kadaluarsa, Kirim Ulang Kode OTP",
            ]);

            return redirect()->route('check.mahasiswa');
        }

        session()->flash('alert', [
            'type' => 'danger',
            'message' => 'Gagal.',
            'detail' => "Kode OTP Salah",
        ]);

        return back();
    }
}
