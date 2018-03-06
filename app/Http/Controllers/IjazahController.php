<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class IjazahController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index($id,$matpel)
  {
    $data = DB::table('nilai')
                              ->leftjoin('siswa','nilai.siswa','=','siswa.id')
                              ->leftjoin('kelas','nilai.kelas','=','kelas.id')
                              ->leftjoin('tahun_ajaran','kelas.tahun_ajaran','=','tahun_ajaran.id')
                              ->where('kelas.kode','=',$id)
                              ->select('nilai.*','siswa.nama','siswa.nis','kelas.kode','kelas.nama_kelas')
                              ->get();
                              // dd($data);
                              // dd(count($data) == 0); 
    return view('ijazah',['data'=>$data,'matpel'=>$matpel]);
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
      if ($request->hasFile('file')) {
            $image = $request->file('file');
            $name = $image->getClientOriginalName();
            $destinationPath = public_path('image');
            $image->move($destinationPath, $name);
            DB::table('nilai')->where('id','=',$request['id'])->update([
                'status' => $request['field2'],
                'bukti' => $name,
                'updated_at' => date('Y-m-d H:i:s')
        ]);
        }
        else {
                DB::table('nilai')->where('id','=',$request['id'])->update([
                    'status' => $request['field2'],
                    'updated_at' => date('Y-m-d H:i:s')
            ]);
        } 

      Session::flash('status','Status Berhasil Disimpan !');
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

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function persiswa($id,$siswa)
  {
    $matpel = DB::table('matpel')->get();
    $idnilai = DB::table('nilai')->where('siswa','=',$siswa)->where('kelas','=',$id)->first();
    $id = DB::table('kelas')->where('id','=',$id)->first();
    $siswa = DB::table('siswa')->where('id','=',$siswa)->first();
    $arrdata = array();
    foreach ($matpel as $key => $pel) {
      $nilai = DB::table('nilai')
                            ->join('transaksi_nilai','transaksi_nilai.nilai','=','nilai.id')
                            ->where('nilai.siswa','=',$siswa->id)
                            ->where('nilai.kelas','=',$id->id)
                            ->where('transaksi_nilai.matpel','=',$pel->id)
                            ->select('transaksi_nilai.*','nilai.id as idnilai')
                            ->first();
      $convert = json_decode(json_encode($nilai), true);
      $rata = ($convert['nilai_kelas4_s1']+$convert['nilai_kelas4_s2']+$convert['nilai_kelas5_s1']+$convert['nilai_kelas5_s2']+$convert['nilai_kelas6_s1']+$convert['uas'])/6;
      $arrdata[] = [$pel->matpel,$convert['nilai_kelas4_s1'],$convert['nilai_kelas4_s2'],$convert['nilai_kelas5_s1'],$convert['nilai_kelas5_s2'],$convert['nilai_kelas6_s1'],$convert['uas'],$rata];
    }
    // dd($arrdata); 
    return view('ijazahsiswa',['kelas'=>$id,'siswa'=>$siswa,'matpel'=>$matpel,'arrdata'=>$arrdata,'idnilai'=>$idnilai]);
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function upload($id)
  {
    $matpel = null;
    $data = DB::table('nilai')
                              ->leftjoin('siswa','nilai.siswa','=','siswa.id')
                              ->leftjoin('kelas','nilai.kelas','=','kelas.id')
                              ->leftjoin('tahun_ajaran','kelas.tahun_ajaran','=','tahun_ajaran.id')
                              ->where('kelas.kode','=',$id)
                              ->select('nilai.*','siswa.nama','siswa.nis','kelas.kode','kelas.nama_kelas')
                              ->get();
                              // dd($data);
                              // dd(count($data) == 0); 
    return view('arsipijazah',['data'=>$data,'matpel'=>$matpel]);
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function uploadijazah(Request $request)
  {
    // DB::table('nilai')->where('id','=',$request['id'])->update([
    //                         'ijazah' => $re
    //   ]);
            $image = $request->file('file');
            $name = $image->getClientOriginalName();
            $destinationPath = public_path('image');
            $image->move($destinationPath, $name);
            DB::table('nilai')->where('id','=',$request['id'])->update([
                'ijazah' => $name,
                'status' => 1,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
    return redirect()->back();
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function uploadserahterima(Request $request)
  {
    // DB::table('nilai')->where('id','=',$request['id'])->update([
    //                         'ijazah' => $re
    //   ]);
            $image = $request->file('file');
            $name = $image->getClientOriginalName();
            $destinationPath = public_path('image');
            $image->move($destinationPath, $name);
            DB::table('nilai')->where('id','=',$request['id'])->update([
                'bukti' => $name,
                'status' => 2,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
    return redirect()->back();
  }
  
}

?>