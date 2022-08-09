<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Storage;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Users::latest()->paginate(10);
        return view('User.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('User.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'photo'     => 'required|image|mimes:png,jpg,jpeg',
            'username'  => 'required',
            'password'  => 'required',
            'nama'      => 'required',
            'umur'      => 'required',
            'agama'     => 'required',
            'kelamin'   => 'required',
            'pendidikan'=> 'required',
            'alamat'    => 'required'
        ]);
    
        //upload image
        $photo = $request->file('photo');
        $photo->storeAs('public/blogs', $photo->hashName());
    
        $user = Users::create([
            'photo'     => $photo->hashName(),
            'username'  => $request->username,
            'password'  => $request->password,
            'nama'      => $request->nama,
            'umur'      => $request->umur,
            'agama'     => $request->agama,
            'kelamin'   => $request->kelamin,
            'pendidikan'=> $request->pendidikan,
            'alamat'    => $request->alamat        ]);
    
        if($user){
            //redirect dengan pesan sukses
            return redirect()->route('users.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('users.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
