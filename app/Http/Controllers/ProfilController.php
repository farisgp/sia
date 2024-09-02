<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\SiswaRepo;
use Hashids\Hashids;



class ProfilController extends Controller
{
    // public function index()
    // {
    //     $user = Auth::user(); 
    //     return view('profil.index', compact('user'));
    // }
    protected $id;
    protected $profil;

    public function __construct(SiswaRepo $profil)
    {
        if(auth()->check()) {
            $this->id = auth()->user()->id;
        }
        $this->profil = $profil;
    }
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'siswa') {
            $siswa = $user->siswa;
            return view('profil.index', compact('siswa'));
        } elseif ($user->role === 'guru') {
            $guru = $user->guru;
            return view('profil.index', compact('guru'));
        }

        // Handle jika peran pengguna bukan siswa atau guru
    }
    public function profil_siswa(Request $user_id)
    {
        $date = date('dMY').'CJ';
        $hashids = new Hashids($date, 14);
        $user_id = $hashids->decode($user_id);
        // dd($user_id);

        $wh = ['user_id' => $user_id];
        // dd($wh);$siswa = $siswa->first();
        $d['siswa'] = $this->profil->getSiswa($wh)->first();
        dd($d['siswa']);

        $d['user_id'] = $user_id;
        // dd($d);
        return view('profil.profil_siswa', $d);

    }
    public function profil_guru($id)
    {
        $date = date('dMY').'CJ';
        $hashids = new Hashids($date, 14);
        $user_id = $hashids->decode($id);
        // dd($user_id);

        $wh = ['user_id' => $user_id];
        // dd($wh);
        $d['guru'] = $this->profil->getGuru($wh);
        $d['user_id'] = $user_id;
        // dd($d);
        return view('profil.profil_guru', $d);

    }
}
