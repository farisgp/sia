<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\KelolaUser;
use App\Models\Admin;
use App\Models\Guru;
use App\Models\Siswa;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class KelolaUserController extends Controller
{
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */

        protected function validator(array $data)
        {
            return Validator::make($data, [
                'username' => ['required', 'string', 'max:255'],
                // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'role' => ['required', 'string'],
            ]);
        }
        public function add_user(Request $request)
        {
            return view('kelola_user.form');
        }
        public function insert_user(Request $request)
        {
            request()->validate( [
                'username' => 'required|string|max:255',
                'password' => 'required|string|min:4|confirmed',
                'role' => 'required|string',
            ]);
        }
        public function profile_guru($id){
            $profile = KelolaUser::where('id_guru', Auth::id())->get();
            return view('kelola_guru.biodata_guru', compact('profile'));
        }
        public function index()
        {
            $kelola = KelolaUser::all();
            return view('kelola_user.index', compact('kelola'));
        }
    
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        protected function create()
        {
            // $user = User::create([
            //     'username' => $data['username'],
            //     // 'email' => $data['email'],
            //     'password' => Hash::make($data['password']),
            //     'role' => $data['role'],
            // ]);
            // return view('kelola_user.form');
            
            return view('kelola_user.form');
        }
        
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            
            $request->validate(
                [
                'username' => 'required',
                'password' => 'required|min:4',
                'role' => 'required',
                ],
            //custom pesan errornya
                [
                'username.required' => 'Nama Wajib Diisi',
                'password.required' => 'Password Wajib Diisi',
                'password.min' => 'Password Wajib Diisi Minimal 4 Karakter',
                'role.required' => 'Role Wajib Diisi',
    
                ]
            );
            $user = KelolaUser::create(
                [
                    'username' => $request->input('username'),
                    'password' => Hash::make($request->input('password')),
                    'role' => $request->input('role'),
                    'created_at' => now(),
                ]
            );
            // if ($request['role'] == 'guru' or 'Guru') {
            //     Guru::create([
            //         'username' => 'username',
            //         'password' => 'password',
            //     ]);
            // } elseif ($request['role'] == 'siswa' or 'Siswa') {
            //     Siswa::create([
            //         'username' => 'username',
            //         'password' => 'password',
            //     ]);
            // } elseif ($request['role'] == 'admin' or 'Admin') {
            //     Admin::create([
            //         'username' => 'username',
            //         'password' => 'password',
            //     ]);
            // }
            Auth::login($user);
            return redirect('/kelola_user')
            ->with('success', 'User Baru Berhasil Disimpan');
        }
    
        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            $row = KelolaUser::find($id);
            return view('kelola_user.detail', compact('row'));
        }
        public function show2($user_id)
        {
            $date = date('dMY').'CJ';
            $hashids = new Hashids($date, 14);
            $user_id = $hashids->decode($user_id);

            if(!$user_id){return back();}

            $data['user'] = $this->user->find($user_id);

            /* Prevent Other Students from viewing Profile of others*/
            // if(Auth::user()->id != $user_id && !Qs::userIsTeamSAT() && !Qs::userIsMyChild(Auth::user()->id, $user_id)){
            //     return redirect(route('dashboard'))->with('pop_error', __('msg.denied'));
            // }

            return view('profil.index', $data);
        }
    
        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $row = KelolaUser::find($id);
            return view('kelola_user.form_edit', compact('row'));
        }
    
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {
            $request->validate(
                [
                'username' => 'required',
                'password' => 'required|min:4',
                'id_siswa' => 'nullable',
                'id_guru' => 'nullable',
                ]);
    
            DB::table('users')->where('id', $id)->update(
                [
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'id_siswa' => $request->id_siswa,
                    'id_guru' => $request->id_guru,
                    'updated_at' => now(),
                ]
            );
    
            return redirect()->route('kelola_user.index')
                ->with('success', 'Status Kelola User Berhasil Diupdate');
        }
    
        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            KelolaUser::where('id', $id)->delete();
            return redirect()->route('kelola_user.index')
                ->with('success', 'Data Kelola User Berhasil Dihapus');
        }
}
