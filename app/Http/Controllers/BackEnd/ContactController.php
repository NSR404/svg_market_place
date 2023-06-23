<?php

namespace App\Http\Controllers\BackEnd;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Auth;
use Illuminate\Http\Request;
use Throwable;

class ContactController extends Controller
{

    public function __construct()
    {
        // Staff Permission Check
        $this->middleware(['permission:view_contacts'])->only('index');
        $this->middleware(['permission:edit_contacts'])->only('markAsRead');
    }



    public function index(Request $request)
    {
        $sort_search        = null;
        $read_by            = $request->type == 'read' ? 1 : false;
        $contacts           =  Contact::query();
        $contacts           =   $read_by    ?   $contacts->whereNotNull('read_by') : $contacts->whereNull('read_by');
        if ($request->has('search')){
            $sort_search = $request->search;
            $contacts->where(function ($q) use ($sort_search){
                $q->where('name', 'like', '%'.$sort_search.'%')
                ->orWhere('phone', 'like', '%'.$sort_search.'%')
                ->orWhere('email', 'like', '%'.$sort_search.'%')
                ->orWhere('message', 'like', '%'.$sort_search.'%');
            });
        }
        $data['contacts']       =   $contacts->paginate(15);
        $data['type']           =   $request->type;
        $data['sort_search']    =   $sort_search;
        return view('backend.contacts.index' , $data);
    }


    /**
     * Mark Contacts As Read.
     */
    public function markAsRead(Request $request)
    {
        try{
            Contact::query()->findOrFail($request->id)->update([
                'read_by'       =>  Auth::id(),
            ]);
            $response_data  =   ResponseHelper::generateResponse(true  , null ,  '#show-contact-modal' , $request->id);
        }catch(Throwable $e)
        {
            $response_data  =   ResponseHelper::generateResponse(false);
        }
        return response()->json($response_data);
    }



}
