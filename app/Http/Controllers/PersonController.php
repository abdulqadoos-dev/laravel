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
            'message' => 'Person Created Successfully',
            'persons' => new PersonRescource($this->person->paginate(10))
        ], 200);
    }

    public function save(PersonRequest $request)
    {
        $form_data = $this->person->create($request->all());

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
            'message' => 'Person Created Successfully',
            'persons' => new PersonRescource($this->findOrFail->find($id))
        ], 200);
    }


}
