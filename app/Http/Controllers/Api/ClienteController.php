<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Repository\ClienteRepository;

class ClienteController extends Controller
{
    private $repository;

    public function __construct(ClienteRepository $repository ) {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = $this->repository->index();
            return response()->json($data, 200);
        } catch (\Exception $th) {
            return response()->json([], 204);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClienteRequest $request)
    {
        try {
            $data = $this->repository->create($request->validated());
            return response()->json($data, 200);
        } catch (\Exception $th) {
            return response()->json([], 204);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $data = $this->repository->show($id);
            return response()->json($data, 200);
        } catch (\Exception $th) {
            return response()->json([], 204);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClienteRequest $request, $id)
    {
        try {

            $data = $this->repository->update($id, $request->validated());
            return response()->json($data, 200);
        } catch (\Exception $th) {
            return response()->json([], 204);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = $this->repository->delete($id);
            return response()->json($data, 200);
        } catch (\Exception $th) {
            return response()->json([], 204);
        }
    }
}
