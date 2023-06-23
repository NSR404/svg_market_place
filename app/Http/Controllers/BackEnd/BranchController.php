<?php

namespace App\Http\Controllers\BackEnd;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Branch\CreateBranchReqeust;
use App\Models\Branch;
use App\Models\BranchTranslation;
use Illuminate\Http\Request;
use Throwable;

class BranchController extends Controller
{


    public function __construct()
    {
        // Staff Permission Check
        $this->middleware(['permission:view_branch'])->only('index');
        $this->middleware(['permission:create_branch'])->only(['create' , 'store']);
        $this->middleware(['permission:update_branch'])->only(['edit' , 'update']);
        $this->middleware(['permission:delete_branch'])->only('destroy');
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['lang']       =   $request->lang;
        $sort_search        = null;
        $branches           =  Branch::query();
        if ($request->has('search')){
            $sort_search = $request->search;
            $branches->where(function ($q) use ($sort_search){
                $q->where('name', 'like', '%'.$sort_search.'%')
                ->orWhere('emails', 'like', '%'.$sort_search.'%')
                ->orWhere('address', 'like', '%'.$sort_search.'%');
            });
        }
        $data['branches']   =   $branches->paginate(15);
		return view('backend.branches.index' , $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data['lang']       =   $request->lang;
        return view('backend.branches.create'  , $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBranchReqeust $request)
    {
        try{
            $data   =   $request->except(['_token']);
            $data['phone_numbers']  =   json_encode(($request->phone_numbers));
            $data['emails']         =  json_encode($request->email);
            $branch = Branch::query()->create($data);
            $branch_translation = BranchTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'branch_id' => $branch->id]);
            $branch_translation->name = $request->name;
            $branch_translation->address = $request->address;
            $branch_translation->save();
            $response_data      =   ResponseHelper::generateResponse(true , 'branches.index');
        }catch(Throwable $e)
        {
            $response_data      =   ResponseHelper::generateResponse(false);
        }
        return response()->json($response_data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request ,  $id)
    {
        $data['lang']       =   $request->lang;
        $data['branch'] = Branch::query()->findOrFail(decrypt($id));
        return view('backend.branches.edit'  , $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateBranchReqeust $request, $id)
    {
        try{
            $branch                 =   Branch::query()->findOrFail($id);
            $data                   =   $request->except(['_token' , '_method']);
            $data['phone_numbers']  =   json_encode(($request->phone_numbers));
            $data['emails']         =  json_encode($request->email);
            $branch->update($data);
            $branch_translation = BranchTranslation::firstOrNew(['lang' => $request->lang, 'branch_id' => $branch->id]);
            $branch_translation->name = $request->name;
            $branch_translation->address = $request->address;
            $branch_translation->save();
            $response_data      =   ResponseHelper::generateResponse(true , null);
        }catch(Throwable $e)
        {
            $response_data      =   ResponseHelper::generateResponse(false);
        }
        return response()->json($response_data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Branch::query()->findOrFail($id)->delete();
        flash(ResponseHelper::getSuccessMessage())->success();
        return back();
    }
}
