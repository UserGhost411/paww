<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Document;
use App\Models\DocumentCategory;
use App\Models\DocumentFlow;
use App\Models\User;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = [count(Document::all()),count(User::all()),4];
        $doc = DB::table('documents')
        ->selectRaw("documents.*,
        (select displayname from users where id=(select flow_actor from flows where flow_id=documents.doc_flow Order by id desc limit 1)) as last_actor,
        count(flows.flow_title) as flow_total_step,
        (flow_step-1) as flow_active_step,
        document_flow.docflow_title")
        ->where('doc_author', Auth::id())->where('doc_status',0)
        ->join('flows', 'documents.doc_flow', '=', 'flows.flow_id','')
        ->join('document_flow', 'documents.doc_flow', '=', 'document_flow.id','')
        ->groupBy("documents.id")
        ->get();
        $linamasa = DB::table('documents')
        ->selectRaw("documents.*,
        (select displayname from users where id=(select flow_actor from flows where flow_id=documents.doc_flow Order by id desc limit 1)) as last_actor,
        count(flows.flow_title) as flow_total_step,
        (flow_step-1) as flow_active_step,
        document_flow.docflow_title")
        ->where('doc_author', Auth::id())
        ->join('flows', 'documents.doc_flow', '=', 'flows.flow_id','')
        ->join('document_flow', 'documents.doc_flow', '=', 'document_flow.id','')
        ->groupBy("documents.id")
        ->get();
        $statustext = ['Pending','Done','Declined','Cancelled'];
        $statusclass = ['warning','success','danger','info'];
        return view("panel/dashboard",compact('linamasa','status','doc','statustext','statusclass'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "nama" =>"required",
            "kode" =>"required|unique:barang,kode_barang",
            "harga"=>"required|numeric",
            "des"=>"required",
            "satuan"=>"required|exists:satuan,id"
        ]);
        $barang = new Barang;
        $barang->nama_barang = $request->nama;
        $barang->kode_barang = $request->kode;
        $barang->harga_barang = $request->harga;
        $barang->deskripsi_barang = $request->des;
        $barang->satuan_id = $request->satuan;
        $barang->save();
        return redirect()->action([BarangController::class, 'index'])->with("info","Data telah ditambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
       
    }
}
