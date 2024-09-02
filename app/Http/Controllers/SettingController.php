<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Requests\SettingUpdate;
use App\Repositories\KelasRepo;
use App\Repositories\SettingRepo;
Use DB;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $setting, $kelas;

    public function __construct(SettingRepo $setting, KelasRepo $kelas)
    {
        $this->setting = $setting;
        $this->kelas = $kelas;
    }

    public function index()
    {
         $s = $this->setting->all();
         $d['s'] = $s->flatMap(function($s){
            return [$s->type => $s->deskripsi];
        });
        return view('admin.settings', $d);
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
    public function update(Request $req)
    {
        $req->validate([
            'tahun_ajaran' => 'required|min:4',
        ]
        );
        DB::table('settings')->update(
            [
                'deskripsi' => $req->tahun_ajaran,
                'updated_at' => now()
            ]
        );

        return back()->with('success', 'Semester System Telah Di Perbarui');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
