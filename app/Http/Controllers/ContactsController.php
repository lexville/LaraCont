<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Contact;
use App\Group;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $contacts = Contact::where(function($query) use ($request) {
            // Filter by selected group
            if ( ($group_id = $request->get("group_id") ) ) {
                $query->where("group_id", $group_id);
            }
        })
        ->orderBy("id", "desc")
        ->paginate(5);
        $contactsCount = Contact::all();
        $groups = Group::all();
        return view('contacts.index', [
            'contacts' => $contacts,
            'groups' => $groups,
            'contactsCount' => $contactsCount
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contacts = Contact::paginate();
        $contactsCount = Contact::all();
        $groups = Group::orderBy("id", "desc")->get();
        return view("contacts.create", [
            'contactsCount' => $contactsCount,
            'groups' => $groups,
            'contacts' => $contacts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:1000',
            'company' => 'required|max:1000',
            'email' => 'required|email',
            'phone' => 'required|max:1000',
            'address' => 'required|max:1000'
        ]);
        $data = $request->all();
        Contact::create($data);

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
