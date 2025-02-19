<?php

namespace App\Http\Controllers\Backend\Admin\Contacts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Admin\Contacts\UpdateContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin', 'admin.permissions:contacts_management']) ; 
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = $this->searchFilter() ; 
        return view('backend.admin.contacts.index' , compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = Contact::findOrFail($id) ; 
        if(!$contact){
            display_error_message('Error Try Again!') ;
            return redirect()->back() ;
        }
        if($contact->is_read == 0){
            $contact->update(['is_read' => 1]) ; 
        }
        return view('backend.admin.contacts.show' , compact('contact')) ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contact = Contact::findOrFail($id) ;
        if(!$contact){
            display_error_message('Error Try Again!') ;
            return redirect()->back() ;
        }
        return view('backend.admin.contacts.edit' , compact('contact')) ; 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, string $id)
    {
        $contact = Contact::findOrFail($id) ;
        if(!$contact){
            display_error_message('Error Try Again!') ;
            return redirect()->back() ;
        }
        $contact_updated = $contact->update($request->only(['name' , 'email' , 'subject' , 'address' , 'phone' , 'is_read' , 'message'])) ;
        if(!$contact_updated){
            display_error_message('Error Try Again!') ;
            return redirect()->back() ;
        }
        display_success_message('Contact Updated Successfully!') ; 
        return redirect()->back() ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $contact = Contact::findOrFail($id) ; 
        if(!$contact){
            display_error_message('Error Try Again!') ;
            return redirect()->back() ; 
        }
        $contact->delete() ;
        display_success_message('Contact Deleted Successfully!') ; 
        return redirect()->back() ; 
    }

    private function searchFilterQueryParams()
    {
        $search = request()->query('search');
        $status = request()->query('status');
        $limit_by = request()->query('limit_by') ?? 5;
        $sort_by = request()->query('sort_by') ?? 'id';
        $order_by = request()->query('order_by') ?? 'desc';
        return[
            'search' => $search,
            'status' => $status , 
            'limit_by' => $limit_by , 
            'sort_by' => $sort_by , 
            'order_by' => $order_by , 
        ] ;
    }

    private function searchFilter()
    {
        $queryParams[] = $this->searchFilterQueryParams();
        $search = $queryParams[0]['search'] ; 
        $status = $queryParams[0]['status'] ; 
        $limit_by = $queryParams[0]['limit_by'] ; 
        $sort_by = $queryParams[0]['sort_by'] ; 
        $order_by = $queryParams[0]['order_by'] ;

        $contacts = Contact::query()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'LIKE', "%" . $search . "%")
                    ->orwhere('subject', 'LIKE', "%" . $search . "%")
                    ->orwhere('message', 'LIKE', "%" . $search . "%");
            })
            ->when(!is_null($status), function ($query) use ($status) {
                $query->where('is_read', $status);
            })
            ->orderBy($sort_by, $order_by)
            ->paginate($limit_by);
         return $contacts;
    }
}
