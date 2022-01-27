<?php

namespace App\Http\Controllers;

use App\Models\DocumentFlow;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\DocumentCategory;
use App\Models\Flows;
use App\Models\Files;
use App\Models\User;


class DocumentFlowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Auth::user()->level!=3) return abort(404);
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Daftar Flow Dokumen";
        $statustext = ['Pending','Done','Declined','Cancelled'];
        $statusclass = ['warning','success','danger','info'];
        $docflow = DB::table('document_flow')
        ->selectRaw("document_flow.*,document_category.category_name,(select count(id) from flows where flow_id=document_flow.id) as total_flow")
        ->join('document_category', 'document_category.id', '=', 'document_flow.docflow_category','')
        ->get();
        return view("panel/listflow",compact('docflow','statustext','statusclass','title'));
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
     * @param  \App\Models\DocumentFlow  $docflow
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $docflow=DocumentFlow::findOrFail($id);
        $flows = DB::table('flows')
        ->selectRaw("flows.*,users.displayname as actor")
        ->where('flow_id', $docflow->id)
        ->join('users', 'users.id', '=', 'flows.flow_actor')
        ->get();
        $title="Dokumen Flow: ".$docflow->docflow_title;
        return view("panel/listflows",compact('title','docflow','flows'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $flow = Flows::findOrFail($id);
        $actors = User::where('level',2)->get();
        return view("panel/editflow",compact('flow','actors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $flow = Flows::findOrFail($id);
        $flow->flow_title=$req->title;
        $flow->flow_description=$req->des;
        $flow->flow_actor=$req->actor;
        $flow->actor_can_decline=$req->decline;
        $flow->actor_can_commit=$req->commit;
        $flow->save();
        return redirect()->route('documentflow.show',[$flow->flow_id]);
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
