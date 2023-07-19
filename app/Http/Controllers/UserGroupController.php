<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Throwable;

class UserGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['groups'] =   UserGroup::query()->latest()->paginate(15);
        return view('backend.marketing.user_groups.index' , $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            UserGroup::query()->create($request->toArray());
            $response  = ResponseHelper::generateResponse(true , 'user-groups.index' , '#create-update-user-group-modal');
        }catch(Throwable $e)
        {
            $response =  ResponseHelper::generateResponse(false);
        }
        return response()->json($response);
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            UserGroup::query()->find($id)->update($request->toArray());
            $response  = ResponseHelper::generateResponse(true , 'user-groups.index' , '#create-update-user-group-modal');
        }catch(Throwable $e)
        {
            $response =  ResponseHelper::generateResponse(false);
        }
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , $id)
    {
        try{
            UserGroup::query()->find($id)->delete();
            flash(__('custom.response_messages.Success'));
        }catch(Throwable $e)
        {
            dd($e);
            flash(__('custom.response_messages.error'));
        }
        return back();
    }
}
