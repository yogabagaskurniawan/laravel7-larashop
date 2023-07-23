<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name', 'asc')->paginate(10);
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $users = User::orderBy('name', 'asc')->get();
        $users = null;
        return view('admin.user.form', compact('users'));
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
            'name' => 'string|required|min:2',
            'status' => 'string|required|min:2',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->only(['name', 'status', 'email']);
        $data['password'] = Hash::make($request->input('password'));

        // Simpan data pengguna ke dalam database
        User::create($data);

        // Redirect atau lakukan tindakan lain setelah penyimpanan berhasil
        return redirect('/admin/hakaccess')->with('success', 'Data pengguna berhasil disimpan!');
        
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
        $users = User::findOrFail($id);
        // $categories = Categories::orderBy('name', 'asc')->get();

        return view('admin.user.form', compact('users'));
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
        $this->validate($request, [
            'name' => 'string|required|min:2',
            'status' => 'string|required|min:2',
            'email' => 'required|email|unique:users,email,' . $id, // Menambahkan $id agar validasi unik dikecualikan untuk record dengan ID yang sedang diperbarui.
            'password' => 'required|min:6',
        ]);

        // Cari record pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Perbarui data pengguna
        $user->name = $request->input('name');
        $user->status = $request->input('status');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        // Redirect atau lakukan tindakan lain setelah penyimpanan berhasil
        return redirect('/admin/hakaccess')->with('success', 'Data pengguna berhasil disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success','Data pengguna berhasil dihapus');
    }
}
