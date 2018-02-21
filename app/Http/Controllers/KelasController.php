<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class KelasController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $data = DB::table('kelas')
                              ->join('tahun_ajaran','kelas.tahun_ajaran','=','tahun_ajaran.id')
                              ->join('walikelas','kelas.wali_kelas','=','walikelas.id')
                              ->join('users','walikelas.user_id','=','users.id')
                              ->select('kelas.nama_kelas',
                                        'tahun_ajaran.nama',
                                        'tahun_ajaran.status',
                                        'users.name',
                                        'walikelas.nip',
                                        'kelas.id')
                              ->get();
    $data2 = DB::table('tahun_ajaran')->get();
    $data3 = DB::table('walikelas')
                              ->join('users','walikelas.user_id','=','users.id')
                              ->select('walikelas.id','users.name')
                              ->get();
    return view('kelas',['data' => $data,'data2' => $data2,'data3' => $data3]);
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
      DB::table('kelas')->insert([
                'nama_kelas' => $request['field1'],
                'kode' => substr(md5(uniqid(mt_rand(), true)) , 0, 8),
                'tahun_ajaran' => $request['field2'],
                'wali_kelas' => $request['field3'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
        ]);
      Session::flash('wksimpan','Data (Kelas) Berhasil Disimpan !');
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
    $data = DB::table('kelas')
                              ->join('tahun_ajaran','kelas.tahun_ajaran','=','tahun_ajaran.id')
                              ->join('walikelas','kelas.wali_kelas','=','walikelas.id')
                              ->where('kelas.id','=',$id)
                              ->select('kelas.*')
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
    DB::table('kelas')->where('id','=',$request['id'])->update([
                  'nama_kelas'    => $request['field1'],
                  'tahun_ajaran'  => $request['field2'],
                  'wali_kelas'    => $request['field3'],
                  'updated_at'    => date('Y-m-d H:i:s')
      ]);
    Session::flash('klsupdate','Data (Kelas) Berhasil Diedit !');
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
    DB::table('kelas')->where('id','=',$id)->delete();
    DB::table('role_user')->where('user_id','=',$id)->delete();
    Session::flash('kepsekhapus','Kepala Sekolah Telah Dihapus !');
    return redirect()->back();
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function detail($id)
  {
    $data = DB::table('kelas')
                              ->join('tahun_ajaran','kelas.tahun_ajaran','=','tahun_ajaran.id')
                              ->join('walikelas','kelas.wali_kelas','=','walikelas.id')
                              ->join('users','walikelas.user_id','=','users.id')
                              ->select('kelas.nama_kelas',
                                        'tahun_ajaran.nama',
                                        'tahun_ajaran.status',
                                        'users.name',
                                        'walikelas.nip',
                                        'kelas.id as idkelas')
                              ->where('kelas.id','=',$id)
                              ->first();
    $data2 = DB::table('nilai')->leftjoin('siswa','nilai.siswa','=','siswa.id')->select('siswa.*','nilai.id as idnilai')->where('nilai.kelas','=',$id)->get();
    $data3 = DB::table('siswa')->whereNotIn('id', function($q){
              $q->select('siswa')->from('nilai')->join('kelas','kelas.id','=','nilai.kelas')->where('kelas.tahun_ajaran','=',DB::table('tahun_ajaran')->where('status','=',2)->first()->id);
              })->get();
    // dd($data3);
    return view('kelasdetail',['data'=>$data,'data2'=>$data2,'data3'=>$data3]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function tambahsiswa(Request $request)
  {
    DB::table('nilai')->insert([
                    'siswa' => $request['field2'],
                    'kelas' => $request['id'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
      ]);    
    Session::flash('tambahsiswa','Siswa Telah Ditambahkan !');
    return redirect()->back();
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroysiswa($id)
  {
    DB::table('nilai')->where('id','=',$id)->delete();
    Session::flash('hapussiswa','Siswa Telah Dihapus !');
    return redirect()->back();
  }
  
}

?>