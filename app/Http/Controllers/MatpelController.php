<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class MatpelController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $data = DB::table('matpel')->get();
    return view('matpel',['data' => $data]);
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
      DB::table('matpel')->insert([
                'matpel' => $request['field1'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
        ]);
      Session::flash('matpelsimpan','Data (matapelajaran) Berhasil Disimpan !');
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
    $data = DB::table('matpel')->where('id','=',$id)->first();
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
    DB::table('matpel')->where('id','=',$request['id'])->update([
                  'matpel' => $request['field1'],
                  'updated_at' => date('Y-m-d H:i:s')
      ]);
    Session::flash('matpelupdate','Data (matapelajaran) Berhasil Diedit !');
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
    DB::table('matpel')->where('id','=',$id)->delete();
    Session::flash('matpelhapus','Kepala Sekolah Telah Dihapus !');
    return redirect()->back();
  }
  
}

?>