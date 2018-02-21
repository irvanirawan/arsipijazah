<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class SiswaController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $data = DB::table('siswa')->whereNull('deleted_at')->get();
    return view('siswa',['data' => $data]);
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
      DB::table('siswa')->insert([
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
      Session::flash('siswasimpan','Data (siswa) Berhasil Disimpan !');
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
    return json_encode(DB::table('siswa')->where('id','=',$id)->first());
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
    DB::table('siswa')->where('id','=',$request['id'])->update([
                'nama'          => $request['field1'],
                'nis'           => $request['field2'],
                'tempat_lahir'  => $request['field3'],
                'tanggal_lahir' => $request['field4'],
                'jenis_kelamin' => $request['field5'],
                'agama'         => $request['field6'],
                'alamat'        => $request['field7'],
                'nama_ortu'     => $request['field8'],
                'updated_at' => date('Y-m-d H:i:s')
      ]);
    Session::flash('siswaupdate','Data (siswa) Berhasil Diedit !');
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
    DB::table('siswa')->where('id','=',$id)->update([
                  'deleted_at' => date('Y-m-d H:i:s')
      ]);
    Session::flash('siswahapus','Data (Siswa) Telah Dihapus !');
    return redirect()->back();
  }
  
}

?>