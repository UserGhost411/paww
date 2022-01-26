<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\DocumentCategory;
use App\Models\DocumentFlow;
use App\Models\Flows;
use App\Models\Files;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Semua Dokumen";
        $statustext = ['Pending','Done','Declined','Cancelled'];
        $statusclass = ['warning','success','danger','info'];
        $doc = DB::table('documents')
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

        return view("panel/listdoc",compact('doc','statustext','statusclass','title'));
    }

    public function active()
    {
        $title = "Dokumen Aktif";
        $statustext = ['Pending','Done','Declined','Cancelled'];
        $statusclass = ['warning','success','danger','info'];
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

        return view("panel/listdoc",compact('doc','statustext','statusclass','title'));
    }
    public function nonactive()
    {
        $title = "Dokumen Usang";
        $statustext = ['Pending','Done','Declined','Cancelled'];
        $statusclass = ['warning','success','danger','info'];
        $doc = DB::table('documents')
            ->selectRaw("documents.*,
            (select displayname from users where id=(select flow_actor from flows where flow_id=documents.doc_flow Order by id desc limit 1)) as last_actor,
            count(flows.flow_title) as flow_total_step,
            (flow_step-1) as flow_active_step,
            document_flow.docflow_title")
            ->where('doc_author', Auth::id())->where('doc_status','>',1)
            ->join('flows', 'documents.doc_flow', '=', 'flows.flow_id','')
            ->join('document_flow', 'documents.doc_flow', '=', 'document_flow.id','')
            ->groupBy("documents.id")
            ->get();

        return view("panel/listdoc",compact('doc','statustext','statusclass','title'));
    }
    public function download(Files $file){
        return Storage::download($file->file_filepath,$file->file_name);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doc = DocumentFlow::all();
        return view("panel/createdoc",compact('doc'));
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
            'title' => 'required',
            'flow' => 'required|exists:document_flow,id',
            'des' => 'required',
            'docfile' => 'required|file'
        ]);

        $doc = new Document;
        $doc->doc_title = $request->title;
        $doc->doc_description = $request->des;
        $doc->flow_step = 1;
        $doc->doc_status = 0;
        $doc->doc_flow = $request->flow;
        $doc->doc_author = Auth::id();
        $doc->save();
        $file = $request->file('docfile');
        $path = $request->file('docfile')->store('');
        $newfiles = new Files;
        $newfiles->file_filepath = $path;
        $newfiles->file_name = $file->getClientOriginalName();
        $newfiles->file_uploader = Auth::id();
        $newfiles->file_document = $doc->id;
        $newfiles->file_origin = true;
        $newfiles->save();

        return redirect()->action([DocumentController::class, 'index'])->with("info","Data telah ditambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        $doc = $document;
        if($doc->doc_author!=Auth::id()) return redirect()->action([DocumentController::class, 'index'])->with("info","404");
        $flows = DB::table('flows')
        ->selectRaw("flows.*,document_process.updated_at as updated_at,users.displayname,document_process.process_status,document_process.process_reason,document_process.updated_at as log_updated")
        ->where('flow_id', $doc->doc_flow)
        ->join('users', 'users.id', '=', 'flows.flow_actor')
        ->leftJoin('document_process', function ($join) use ($doc) {
            $join->on('document_process.process_flows', '=', 'flows.id')->where('document_process.process_document', $doc->id);
        })->get();
        $files = DB::table('files')
        ->selectRaw("files.*,users.displayname")
        ->where('file_document', $doc->id)
        ->join('users', 'users.id', '=', 'files.file_uploader','')
        ->get();
        $logs = DB::table('document_logs')
        ->selectRaw("document_logs.*,users.displayname,flows.flow_title")
        ->where('document_logs.log_document', $doc->id)
        ->join('users', 'users.id', '=', 'document_logs.log_actor')
        ->join('flows', 'flows.id', '=', 'document_logs.log_flows')
        ->get();
        $statustext = ['Pending','Process','Done','Declined','Cancelled'];
        $statusclass = ['warning','info','success','danger','info'];
        $statusdes = ['Dokumen Anda Sedang dalam List Antrian','Dokumen Anda Sedang dalam Pemrosesan','Dokumen anda Telah diverifikasi dan diProses','Dokumen anda Ditolak Tanpa Alasan','Dokumen anda telah dibatalkan'];
        //return $logs;
        
        return view("panel/viewdoc",compact('doc','flows','statustext','statusclass','statusdes','logs','files'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        //
    }
}
