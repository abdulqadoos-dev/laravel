<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonRequest;
use App\Http\Resources\PersonRescource;
use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{

    public $person;

    public function __construct(Person $person)
    {
        return $this->person = $person;
    }


    public function index()
    {
        return response()->json([
            'status' => true,
            'message' => 'Person Retrieved Successfully',
            'persons' => new PersonRescource($this->person->paginate(10))
        ], 200);
    }

    public function save(PersonRequest $request)
    {
        $form_data = $this->person->create([
            'name' => $request->name,
            'description' => $request->description,
            'file' =>  $request->file('file')->store('persons', 'public'),
            'type' => $request->type
        ], 200);

        return response()->json([
            'status' => true,
            'message' => 'Person Created Successfully',
            'person' => new PersonRescource($form_data)
        ], 200);
    }

    public function details($id)
    {
        return response()->json([
            'status' => true,
            'message' => 'Person Retrieved Successfully',
            'persons' => new PersonRescource($this->person->findOrFail($id))
        ], 200);
    }


}
