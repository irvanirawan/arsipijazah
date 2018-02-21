<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class UserController extends Controller
{
    /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $data = DB::table('users')
    						->leftjoin('role_user','role_user.user_id','=','users.id')
    						->leftjoin('roles','role_user.role_id','=','roles.id')
    						->select('users.id',
    								'users.name',
									'users.email',
									'roles.display_name',
									'roles.description')
    						->get();
	$role = DB::table('roles')->get();
    return view('user',['data' => $data,'role' => $role]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
      DB::table('user')->insert([
                'nama'          => $request['field1'],
                'nis'           => $request['field2'],
                'tempat_lahir'  => $request['field3'],
                'tanggal_lahir' => $request['field4'],
                'jenis_kelamin' => $request['field5'],
                'agama'         => $request['field6'],
                'alamat'        => $request['field7'],
                'nama_ortu'     => $request['field8'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
        ]);
      Session::flash('usersimpan','Data (user) Berhasil Disimpan !');
      return redirect()->back();
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    return json_encode(DB::table('user')->where('id','=',$id)->first());
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request)
  {
    DB::table('walikelas')->where('user_id','=',$request['id'])->delete();
    DB::table('kepala_sekolah')->where('user_id','=',$request['id'])->delete();
    DB::table('role_user')->where('user_id','=',$request['id'])->delete();
    if ($request['field1'] == 2) {
      DB::table('walikelas')->insert([
                'nip' => $request['nip'],
                'user_id' => $request['id'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
        ]);
    } elseif ($request['field1'] == 3) {
      DB::table('kepala_sekolah')->insert([
                'nip' => $request['nip'],
                'user_id' => $request['id'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
    DB::table('role_user')->insert([
                'user_id' => $request['id'],
                'role_id' => $request['field1']
      ]);
    // DB::table('user')->where('id','=',$request['id'])->update([
    //             'nama'          => $request['field1'],
    //             'nis'           => $request['field2'],
    //             'tempat_lahir'  => $request['field3'],
    //             'tanggal_lahir' => $request['field4'],
    //             'jenis_kelamin' => $request['field5'],
    //             'agama'         => $request['field6'],
    //             'alamat'        => $request['field7'],
    //             'nama_ortu'     => $request['field8'],
    //             'updated_at' => date('Y-m-d H:i:s')
    //   ]);
    Session::flash('userupdate','Data (user) Berhasil Diedit !');
    return redirect()->back();
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    DB::table('users')->where('id','=',$id)->delete();
    Session::flash('userhapus','Data (user) Telah Dihapus !');
    return redirect()->back();
  }
}
