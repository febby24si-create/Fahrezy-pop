<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // Data Pegawai
        $pegawai = [
            'name' => 'Febbyta Sari', // Nama Pegawai
            'birth_date' => '2007-03-25', // Tanggal Lahir Pegawai
            'hobbies' => ['Membaca', 'Menonton Film', 'Memasak', 'Menulis', 'Berpetualang'],
            'tgl_harus_wisuda' => '2028-09-30', // Tanggal Harus Wisuda
            'current_semester' => 3, // Semester saat ini
            'future_goal' => 'Menjadi pengusaha sukses',
        ];

        // Menghitung umur berdasarkan tanggal lahir
        $birthDate = Carbon::parse($pegawai['birth_date']);
        $age = $birthDate->age; // Umur Pegawai

        // Menghitung jarak hari dari tanggal wisuda
        $tglHarusWisuda = Carbon::parse($pegawai['tgl_harus_wisuda']);
        $timeToStudyLeft = $tglHarusWisuda->diffInDays(Carbon::now());  // Menggunakan diffInDays()

        // Menentukan pesan berdasarkan semester
        $semesterMessage = $pegawai['current_semester'] < 3
            ? 'Masih Awal, Kejar TAK'
            : 'Jangan main-main, kurang-kurangi main game!';

        // Menyusun data yang akan ditampilkan
        $data = [
            'name' => $pegawai['name'],
            'my_age' => $age,
            'hobbies' => $pegawai['hobbies'],
            'tgl_harus_wisuda' => $pegawai['tgl_harus_wisuda'],
            'time_to_study_left' => $timeToStudyLeft,
            'current_semester' => $pegawai['current_semester'],
            'semester_message' => $semesterMessage,
            'future_goal' => $pegawai['future_goal']
        ];

        // Menampilkan data dalam bentuk JSON
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
