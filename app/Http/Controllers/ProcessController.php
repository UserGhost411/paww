<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\DocumentCategory;
use App\Models\DocumentFlow;
use App\Models\DocumentProcess;
use App\Models\DocumentLogs;
use App\Models\Flows;
use App\Models\Files;
use Illuminate\Support\Facades\Storage;

class ProcessController extends Controller
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
        $queryyeyek = 'select process_status from document_process where process_actor='.Auth::id().' and process_document=documents.id and process_flows=documents.doc_flow';
        $doc = DB::table('documents')
            ->selectRaw("documents.*,(users.displayname)as displayname,document_flow.docflow_title,flows.flow_title")
            ->whereRaw("documents.doc_status=0")
            ->join('flows',function ($join) {
                $join->on('flows.flow_id', '=','documents.doc_flow')->where('flows.flow_actor', Auth::id());
            })
            ->join('document_flow', 'documents.doc_flow', '=', 'document_flow.id')
            ->join('users', 'users.id', '=', 'documents.doc_author')
            ->groupBy("documents.id")
            ->get();
        $a = new ProcessController;
        return view("panel/progdocs",compact('doc','statustext','statusclass','title','a'));
    }
    public static function checkif($docid){
        $doc = Document::findOrFail($docid);
        $flows = DB::table('flows')->where("flow_id",$doc->doc_flow)->skip($doc->flow_step-1)->first();
        if($flows==null || $flows->flow_actor!=Auth::id()) return false;
        $docpro = DB::table('document_process')
            ->where('process_actor',Auth::id())
            ->where('process_document',$docid)
            ->where('process_flows',$doc->doc_flow)
            ->first();
        if($docpro!=null && $docpro->process_status>1) return false;
        return true;
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
        $doc = new Document;
        $doc->doc_title = $request->title;
        $doc->doc_description = $request->des;
        $doc->flow_step = 1;
        $doc->doc_status = 0;
        $doc->doc_flow = $request->flow;
        $doc->doc_author = 1;
        $doc->save();
        return redirect()->action([DocumentController::class, 'index'])->with("info","Data telah ditambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request){
        $file = $request->file('docfile');
        $path = $request->file('docfile')->store('');
        $newfiles = new Files;
        $newfiles->file_filepath = $path;
        $newfiles->file_name = $file->getClientOriginalName();
        $newfiles->file_uploader = Auth::id();
        $newfiles->file_document = $request->doc;
        $newfiles->file_origin = false;
        $newfiles->save();
        return redirect()->route('process.show', [$request->doc])->with("info","Data telah ditambahkan");
    }
    public function show($id)
    {
        $doc = DB::table('documents')
        ->selectRaw("documents.*,users.displayname,document_flow.docflow_title")
        ->where('documents.id', $id)
        ->join('users', 'users.id', '=', 'documents.doc_author','')
        ->join('document_flow', 'documents.doc_flow', '=', 'document_flow.id','')
        ->first();
        $myflow = DB::table('flows')->where('flow_id', $doc->doc_flow)->where('flow_actor', Auth::id())->first();
        $files = DB::table('files')
        ->selectRaw("files.*,users.displayname")
        ->where('file_document', $doc->id)
        ->join('users', 'users.id', '=', 'files.file_uploader','')
        ->get();
        $progress = DB::table('document_process')
        ->where('process_document', $doc->id)
        ->where('process_actor', Auth::id())
        ->where('process_flows',$myflow->id)->first();
        if($progress === null){
            $newprog = new DocumentProcess;
            $newlog = new DocumentLogs;
            $newprog->process_document = $doc->id;
            $newprog->process_actor = Auth::id();
            $newprog->process_flows = $myflow->id;
            $newprog->process_reason = '';
            $newprog->process_status = 1;
            $newprog->save();
            $newlog->log_document = $doc->id;
            $newlog->log_actor = Auth::id();
            $newlog->log_flows = $myflow->id;
            $newlog->log_reason = '';
            $newlog->log_status = 1;
            $newlog->save();
        }else{
            if($progress->process_status==0){
                $updateprog = DocumentProcess::findOrFail($progress->id);
                $updateprog->process_status=1;
                $updateprog->save();
                $newlog = new DocumentLogs;
                $newlog->log_document = $doc->id;
                $newlog->log_actor = Auth::id();
                $newlog->log_flows = $myflow->id;
                $newlog->log_reason = '';
                $newlog->log_status = 1;
                $newlog->save();
            }
        }
        $statustext = ['Pending','Process','Done','Declined','Cancelled'];
        $statusclass = ['warning','info','success','danger','info'];
        $statusdes = ['Dokumen Anda Sedang dalam List Antrian','Dokumen Anda Sedang dalam Pemrosesan','Dokumen anda Telah diverifikasi dan diProses','Dokumen anda Ditolak Tanpa Alasan','Dokumen anda telah dibatalkan'];
        return view("panel/progdoc",compact('doc','myflow','files','statustext','statusclass','statusdes'));
    }
    public function download(Files $file){
        return Storage::download($file->file_filepath,$file->file_name);
    }
    public function delete(Files $file){
        $iddoc = $file->file_document;
        Storage::delete($file->file_filepath);
        $file->delete();
        return redirect()->route('process.show', [$iddoc])->with("info","Data telah ditambahkan");
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
        if($request->act=='dec'){
            $progress = DB::table('document_process')->where('process_document',$document->id)->where('process_actor', Auth::id())->where('process_flows',$request->process_flows)->first();
            $updateprog = DocumentProcess::findOrFail($progress->id);
            $updateprog->process_status=3;
            $updateprog->save();
            $document->doc_status=2;
            $document->save();
            $newlog = new DocumentLogs;
            $newlog->log_document = $document->id;
            $newlog->log_actor = Auth::id();
            $newlog->log_flows = $request->process_flows;
            $newlog->log_reason = '';
            $newlog->log_status = 3;
            $newlog->save();
            return redirect()->route('process.index')->with("info","Document Telah DiTolak");
        }else if($request->act=='acc'){
            $progress = DB::table('document_process')->where('process_document',$document->id)->where('process_actor', Auth::id())->where('process_flows',$request->process_flows)->first();
            $updateprog = DocumentProcess::findOrFail($progress->id);
            $updateprog->process_status=2;
            $updateprog->save();
            if(($document->flow_step + 1)>DB::table('flows')->where("flow_id",$document->doc_flow)->count())$document->doc_status=1;
            $document->flow_step=($document->flow_step + 1);
            $document->save();
            $newlog = new DocumentLogs;
            $newlog->log_document = $document->id;
            $newlog->log_actor = Auth::id();
            $newlog->log_flows = $request->process_flows;
            $newlog->log_reason = '';
            $newlog->log_status = 2;
            $newlog->save();
            return redirect()->route('process.index')->with("info","Document Telah DiProses");
        }
        return redirect()->route('process.index');
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
