<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class KepsekController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $data = DB::table('kepala_sekolah')
                              ->join('users','kepala_sekolah.user_id','=','users.id')
                              ->select('kepala_sekolah.*','users.name as namanya','users.email as emailnya','users.id as idnya')
                              ->get();
    return view('kepala_sekolah',['data' => $data]);
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
      DB::table('walikelas')->insert([
                'nama' => $request['field1'],
                'nip' => $request['field2'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
        ]);
      Session::flash('wksimpan','Data (guru) Berhasil Disimpan !');
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
    $data = DB::table('kepala_sekolah')
                              ->join('users','kepala_sekolah.user_id','=','users.id')
                              ->where('kepala_sekolah.user_id','=',$id)
                              ->select('kepala_sekolah.*','users.name as namanya','users.email as emailnya','users.id as idnya')
                              ->first();
    return json_encode($data);
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
    DB::table('kepala_sekolah')->where('user_id','=',$request['id'])->update([
                  'nip' => $request['field2'],
                  'updated_at' => date('Y-m-d H:i:s')
      ]);
    DB::table('users')->where('id','=',$request['id'])->update([
                  'name' => $request['field1'],
                  'email' => $request['field3'],
                  'updated_at' => date('Y-m-d H:i:s')
      ]);
    Session::flash('kepsekupdate','Data (guru) Berhasil Diedit !');
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
    DB::table('kepala_sekolah')->where('user_id','=',$id)->delete();
    DB::table('role_user')->where('user_id','=',$id)->delete();
    Session::flash('kepsekhapus','Kepala Sekolah Telah Dihapus !');
    return redirect()->back();
  }
  
}

?>