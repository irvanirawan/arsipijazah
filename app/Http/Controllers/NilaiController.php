<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class NilaiController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index($id)
  {
    $data = DB::table('nilai')
                              ->leftjoin('siswa','nilai.siswa','=','siswa.id')
                              ->leftjoin('kelas','nilai.kelas','=','kelas.id')
                              ->leftjoin('tahun_ajaran','kelas.tahun_ajaran','=','tahun_ajaran.id')
                              ->where('kelas.kode','=',$id)
                              ->select('nilai.*','siswa.nama','siswa.nis','kelas.kode')
                              ->get();
                              // dd($data);
    return view('nilai',['data'=>$data]);
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
      // dd();
      foreach ($request['id'] as $key => $id) {
        // dd(DB::table('transaksi_nilai')->where('nilai','=',$id)->first() == null);
        if (DB::table('transaksi_nilai')->where('nilai','=',$id)->where('matpel','=',$request['matpel'][$key])->first() == null) {
          DB::table('transaksi_nilai')->insert([
                'nilai' => $id,
                'matpel' => $request['matpel'][$key],
                'nilai_kelas4_s1' => $request['k4satu'][$key],
                'nilai_kelas4_s2' => $request['k4dua'][$key],
                'nilai_kelas5_s1' => $request['k5satu'][$key],
                'nilai_kelas5_s2' => $request['k5dua'][$key],
                'nilai_kelas6_s1' => $request['k6satu'][$key],
                'uas' => $request['uas'][$key],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
        ]);
        } elseif(DB::table('transaksi_nilai')->where('nilai','=',$id)->first() != null) {
        DB::table('transaksi_nilai')->where('nilai','=',$id)->where('matpel','=',$request['matpel'][$key])->update([
                'nilai_kelas4_s1' => $request['k4satu'][$key],
                'nilai_kelas4_s2' => $request['k4dua'][$key],
                'nilai_kelas5_s1' => $request['k5satu'][$key],
                'nilai_kelas5_s2' => $request['k5dua'][$key],
                'nilai_kelas6_s1' => $request['k6satu'][$key],
                'uas' => $request['uas'][$key],
                'updated_at' => date('Y-m-d H:i:s')
        ]);
      }

      }
      

      Session::flash('nilaisimpan','Data (nilai) Berhasil Disimpan !');
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

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function nilaipel($id,$matpel)
  {
    $data = DB::table('nilai')
                              ->leftjoin('siswa','nilai.siswa','=','siswa.id')
                              ->leftjoin('kelas','nilai.kelas','=','kelas.id')
                              ->leftjoin('tahun_ajaran','kelas.tahun_ajaran','=','tahun_ajaran.id')
                              ->where('kelas.kode','=',$id)
                              ->select('nilai.*','siswa.nama','siswa.nis','kelas.kode')
                              ->get();
                              // dd(count($data) == null);
    return view('nilai',['data'=>$data,'matpel'=>$matpel]);
  }
  
}

?>