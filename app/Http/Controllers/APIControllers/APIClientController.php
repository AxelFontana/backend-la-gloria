<?php

namespace App\Http\Controllers\APIControllers;

use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\APIControllers\BaseAPIController;

class APIClientController extends BaseAPIController
{

/**
 * @OA\Get(
 *     path="/rest/clients",
 *     tags={"Clients"},
 *     summary="Get all the clients",
 *     description="Get a paginated list of all the clients in the database",
 *     @OA\Response(
 *         response=200,
 *         description="Successful Operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/ClientResource")
 *         ),
 *     )
 * )
 */
    public function index()
    {
        $clients = Client::paginate(9);
        return ClientResource::collection($clients);
    }

/**
 * @OA\Get(
 *     path="/rest/clients/create",
 *     summary="Show the form for creating a new client",
 *     description="Returns a JSON object with the form fields for creating a new client.",
 *     tags={"Clients"},
 *     @OA\Response(
 *         response="200",
 *         description="JSON object with the form fields for creating a new client.",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="fields",
 *                 type="object",
 *                 description="The form fields for creating a new client.",
 *                 @OA\Property(
 *                     property="email",
 *                     type="object",
 *                     description="The email field.",
 *                     @OA\Property(
 *                         property="type",
 *                         type="string",
 *                         example="email"
 *                     ),
 *                     @OA\Property(
 *                         property="label",
 *                         type="string",
 *                         example="Email"
 *                     ),
 *                     @OA\Property(
 *                         property="required",
 *                         type="boolean",
 *                         example=true
 *                     )
 *                 )
 *             )
 *         )
 *     )
 * )
 */
    public function create()
    {
        $clientFields = [
            'email' => [
                'type' => 'email',
                'label' => 'Email',
                'required' => true
            ],
        ];

        return response()->json(['fields' => $clientFields]);
    }


/**
 * @OA\Post(
 *     path="/rest/clients",
 *     summary="Store a newly created resource in storage and return the new client.",
 *     description="Create a new client in the database with the given email address and return the newly created client. The email address must not be already present in the clients database.",
 *     tags={"Clients"},
 *     @OA\RequestBody(
 *         description="Client email address.",
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="email",
 *                 type="string",
 *                 example="john.doe@example.com",
 *                 description="The email address of the new client. Must not be already present in the clients database."
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="Newly created client.",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 description="The newly created client.",
 *                 ref="#/components/schemas/ClientResource"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response="422",
 *         description="Validation errors.",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="The given data was invalid."
 *             ),
 *             @OA\Property(
 *                 property="errors",
 *                 type="object",
 *                 description="Validation errors.",
 *                 @OA\Property(
 *                     property="email",
 *                     type="array",
 *                     description="The email validation error.",
 *                     @OA\Items(
 *                         type="string",
 *                         example="The email field is required."
 *                     )
 *                 )
 *             )
 *         )
 *     )
 * )
 */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:clients,email'
        ]);

        $client = Client::create($validatedData);
        return new ClientResource($client);
    }


/**
 * Retrieves a specific client by ID.
 *
 * @OA\Get(
 *     path="/rest/clients/id/{id}",
 *     summary="Retrieve a specific client",
 *     tags={"Clients"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the client to retrieve",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="Client retrieved successfully",
 *         @OA\JsonContent(ref="#/components/schemas/ClientResource")
 *     ),
 *     @OA\Response(
 *         response="404",
 *         description="Client not found"
 *     )
 * )
 */
    public function show(string $id)
    {
        $client = Client::findOrFail($id);
        return new ClientResource($client);
    }


    /**
 * @OA\Get(
 *     path="/rest/clients/email/{email}",
 *     summary="Get client by email",
 *     tags={"Clients"},
 *     @OA\Parameter(
 *         name="email",
 *         in="path",
 *         description="Client's email",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Client found",
 *         @OA\JsonContent(
 *             ref="#/components/schemas/ClientResource"
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Client not found"
 *     )
 * )
 */
    public function getClientByEmail(string $email)
    {
        $client = Client::where('email', $email)->first();
        return new ClientResource($client);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
