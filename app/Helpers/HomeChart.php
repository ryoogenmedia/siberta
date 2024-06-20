<?php

namespace App\Helpers;

use App\Models\Berkas;

class HomeChart{
    public static function REVISION(){
        $data = [
            'date' => [],
            'data' => [],
        ];

        for ($i = 9; $i >= 0; $i--) {
            $dates = date('Y-m-d', strtotime("-" . $i . " day"));
            $datas = Berkas::where('status_file', 'revision')
                ->whereDate('created_at', $dates)
                ->count();

            $data['date'][] = date('d M Y', strtotime($dates));
            $data['data'][] = $datas ? $datas : 0;
        }

        return $data;
    }


    public static function APPROVE(){
        $data = [
            'date' => [],
            'data' => [],
        ];

        for ($i = 9; $i >= 0; $i--) {
            $dates = date('Y-m-d', strtotime("-" . $i . " day"));
            $datas = Berkas::where('status_file', 'approve')
                ->whereDate('created_at', $dates)
                ->count();

            $data['date'][] = date('d M Y', strtotime($dates));
            $data['data'][] = $datas ? $datas : 0;
        }

        return $data;
    }

    public static function REVISED(){
        $data = [
            'date' => [],
            'data' => [],
        ];

        for ($i = 9; $i >= 0; $i--) {
            $dates = date('Y-m-d', strtotime("-" . $i . " day"));
            $datas = Berkas::where('status_file', 'revised')
                ->whereDate('created_at', $dates)
                ->count();

            $data['date'][] = date('d M Y', strtotime($dates));
            $data['data'][] = $datas ? $datas : 0;
        }

        return $data;
    }

    public static function PENDDING(){
        $data = [
            'date' => [],
            'data' => [],
        ];

        for ($i = 9; $i >= 0; $i--) {
            $dates = date('Y-m-d', strtotime("-" . $i . " day"));
            $datas = Berkas::where('status_file', 'pending')
                ->whereDate('created_at', $dates)
                ->count();

            $data['date'][] = date('d M Y', strtotime($dates));
            $data['data'][] = $datas ? $datas : 0;
        }

        return $data;
    }
}
