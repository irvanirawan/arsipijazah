<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class WalikelasController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $data = DB::table('walikelas')->get();
    return view('walikelas',['data' => $data]);
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
                'nama' => $request['nama'],
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
        ]);
      Session::flash('thsimpan','Tahun Ajaran Berhasil Disimpan !');
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
    return json_encode(DB::table('walikelas')->where('id','=',$id)->first());
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
    DB::table('walikelas')->where('id','=',$request['id'])->update([
                  'nama' => $request['nama']
      ]);
    Session::flash('thupdate','Tahun Ajaran Berhasil Diedit !');
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
    DB::table('walikelas')->where('id','=',$id)->delete();
    Session::flash('thhapus','Tahun Ajaran Telah Dihapus !');
    return redirect()->back();
  }
  
}

?>