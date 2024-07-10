<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Repository\ClienteRepository;
use Illuminate\Http\Request;

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
     *  @OA\Get(
     *      path="/cliente",
     *      summary="Return clientes",
     *      description="Return clientes",
     *      operationId="cliente-index",
     *      tags={"Cliente"},
     *      @OA\Parameter(
     *          name="nome",
     *          in="query",
     *          description="nome",
     *         required=false,
     *      ),
     *      @OA\Parameter(
     *          name="cpf",
     *          in="query",
     *          description="cpf",
     *         required=false,
     *      ),
     *      @OA\Parameter(
     *          name="cidade_id",
     *          in="query",
     *          description="cidade_id",
     *         required=false,
     *      ),
     *      @OA\Parameter(
     *          name="data_nascimento",
     *          in="query",
     *          description="data_nascimento",
     *         required=false,
     *      ),
     *      @OA\Parameter(
     *          name="sexo",
     *          in="query",
     *          description="sexo",
     *         required=false,
     *      ),
     *      @OA\Parameter(
     *          name="uf",
     *          in="query",
     *          description="uf",
     *         required=false,
     *      ),
     *      @OA\Parameter(
     *          name="page",
     *          in="query",
     *          description="Page Number",
     *         required=false,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean", example="true"),
     *              @OA\Property(property="data", type="object",
     *                  @OA\Property(property="current_page", type="integer", example="2"),
     *                  @OA\Property(property="data", type="array",
     *                      @OA\Items(
     *                          @OA\Property(property="id", type="integer", example="1"),
     *                          @OA\Property(property="cidade_id", type="integer", example="2"),
     *                          @OA\Property(property="cpf", type="string", example="99999999954"),
     *                          @OA\Property(property="nome", type="string", example="Pedro Oliveira"),
     *                          @OA\Property(property="data_nascimento", type="date", example="1982-07-03T00:00:00.000000Z"),
     *                          @OA\Property(property="sexo", type="enum", example="masculino"),
     *                          @OA\Property(property="endereco", type="string", example="Rua Alves cardoso 144"),
     *                          @OA\Property(property="created_at", type="date", example="2024-07-09T22:22:07.000000Z"),
     *                          @OA\Property(property="updated_at", type="date", example="2024-07-09T22:22:07.000000Z"),
     *                          @OA\Property(property="deleted_at", type="date", example="null"),
     *                      )
     *                  ),
     *                  @OA\Property(property="first_page_url", type="string", example="http://desafioupd8.teste/api/cliente?sexo=masculino&per_page=2&page=1"),
     *                  @OA\Property(property="from", type="integer", example="1"),
     *                  @OA\Property(property="last_page", type="integer", example="1"),
     *                  @OA\Property(property="last_page_url", type="integer", example="1"),
     *                  @OA\Property(property="links", type="array",
     *                      @OA\Items(
     *                          @OA\Property(property="url", type="string", example="null"),
     *                          @OA\Property(property="label", type="string", example="&laquo; Previous"),
     *                          @OA\Property(property="active", type="boolean", example="false"),
     *                      ),
     *                  ),
     *                  @OA\Property(property="next_page_url", type="string", example="null"),
     *                  @OA\Property(property="path", type="string", example="http://desafioupd8.teste/api/cliente"),
     *                  @OA\Property(property="per_page", type="integer", example="10"),
     *                  @OA\Property(property="prev_page_url", type="string", example="null"),
     *                  @OA\Property(property="to", type="string", example="2"),
     *                  @OA\Property(property="total", type="string", example="2"),
     *          ),
     *        )
     *     ),
     *      @OA\Response(
     *          response=204,
     *          description="Wrong error",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean", example="false"),
     *              @OA\Property(property="message", type="string", example="Sorry, wrong error. Please try again")
     *        )
     *     ),
     *  )
     * )
     */
    public function index(Request $request)
    {
        try {

            $data = $this->repository->search($request->all());
            return response()->json( ['success' => true, 'data' => $data] , 200);
        } catch (\Exception $th) {
            return response()->json( ['success' => false, 'message' => "Validation errors", 'data' => [] ] , 204);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *  @OA\Post(
     *      path="/cliente",
     *      summary="Create cliente",
     *      description="Create cliente",
     *      operationId="cliente-store",
     *      tags={"Cliente"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Create cliente",
     *          @OA\JsonContent(
     *              required={"nome", "cpf", "data_nascimento", "sexo", "endereco", "cidade_id"},
     *              @OA\Property(property="cidade_id", type="integer", example="1"),
     *              @OA\Property(property="nome", type="string", example="Maria Eduarda Oliveira"),
     *              @OA\Property(property="cpf", type="string", example="99999999912"),
     *              @OA\Property(property="data_nascimento", type="date", example="1982/07/03"),
     *              @OA\Property(property="sexo", type="enum", example="masculino ou feminino"),
     *              @OA\Property(property="endereco", type="string", example="Rua Alves cardoso 144"),
     *              @OA\Property(property="uf", type="string", example="SP"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\Property(property="success", type="boolean", example="true"),
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="integer", example="1"),
     *              @OA\Property(property="cidade_id", type="integer", example="1"),
     *              @OA\Property(property="nome", type="string", example="Maria Eduarda Oliveira"),
     *              @OA\Property(property="cpf", type="string", example="99999999912"),
     *              @OA\Property(property="data_nascimento", type="date", example="1982/07/03"),
     *              @OA\Property(property="sexo", type="enum", example="masculino ou feminino"),
     *              @OA\Property(property="endereco", type="string", example="Rua Alves cardoso 144"),
     *              @OA\Property(property="uf", type="string", example="SP"),
     *              @OA\Property(property="created_at", type="date", example="2024-07-09T22:22:07.000000Z"),
     *              @OA\Property(property="updated_at", type="date", example="2024-07-09T22:22:07.000000Z"),
     *              @OA\Property(property="deleted_at", type="date", example="null"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Wrong error",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean", example="false"),
     *              @OA\Property(property="message", type="string", example="Sorry, wrong error. Please try again!")
     *          )
     *      )
     * )
     */
    public function store(StoreClienteRequest $request)
    {
        try {
            $data = $this->repository->create($request->validated());
            return response()->json( ['success' => true, 'data' => $data] , 200);
        } catch (\Exception $th) {
             return response()->json( ['success' => false, 'message' => "Validation errors", 'data' => [] ] , 204);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *  @OA\Get(
     *      path="/cliente/{id}",
     *      summary="Return clientes",
     *      description="Return clientes",
     *      operationId="cliente-show",
     *      tags={"Cliente"},
     *      @OA\Parameter(
     *          description="id",
     *          in="path",
     *          name="id",
     *          required=true,
     *          example="1",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean", example="true"),
     *              @OA\Property(property="data", type="object",
     *                  @OA\Property(property="id", type="integer", example="1"),
     *                  @OA\Property(property="cidade_id", type="integer", example="1"),
     *                  @OA\Property(property="cpf", type="string", example="99999999923"),
     *                  @OA\Property(property="nome", type="string", example="Pedro Oliveira"),
     *                  @OA\Property(property="data_nascimento", type="date", example="1982/07/03"),
     *                  @OA\Property(property="sexo", type="enum", example="masculino"),
     *                  @OA\Property(property="created_at", type="date", example="2024-07-09T22:22:07.000000Z"),
     *                  @OA\Property(property="updated_at", type="date", example="2024-07-09T22:22:07.000000Z"),
     *                  @OA\Property(property="deleted_at", type="date", example="null"),
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Wrong error",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean", example="false"),
     *              @OA\Property(property="message", type="string", example="Sorry, wrong error. Please try again")
     *          )
     *      )
     *  )
     */
    public function show($id)
    {
        try {
            $data = $this->repository->show($id);
            return response()->json( ['success' => true, 'data' => $data] , 200);
        } catch (\Exception $th) {
             return response()->json( ['success' => false, 'message' => "Validation errors", 'data' => [] ] , 204);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *  @OA\Put(
     *      path="/cliente/{id}",
     *      summary="Update clientes",
     *      description="Update clientes",
     *      operationId="cliente-update",
     *      tags={"Cliente"},
     *      @OA\Parameter(
     *          description="id",
     *          in="path",
     *          name="id",
     *          required=true,
     *          example="1",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          description="Update cliente",
     *          @OA\JsonContent(
     *              @OA\Property(property="cidade_id", type="integer", example="1"),
     *              @OA\Property(property="nome", type="string", example="Maria Eduarda Oliveira"),
     *              @OA\Property(property="cpf", type="string", example="99999999912"),
     *              @OA\Property(property="data_nascimento", type="date", example="1982/07/03"),
     *              @OA\Property(property="sexo", type="enum", example="masculino ou feminino"),
     *              @OA\Property(property="endereco", type="string", example="Rua Alves cardoso 144"),
     *              @OA\Property(property="uf", type="string", example="SP"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean", example="true"),
     *              @OA\Property(property="data", type="object",
     *                  @OA\Property(property="id", type="integer", example="1"),
     *                  @OA\Property(property="cidade_id", type="integer", example="1"),
     *                  @OA\Property(property="nome", type="string", example="Maria Eduarda Oliveira"),
     *                  @OA\Property(property="cpf", type="string", example="99999999912"),
     *                  @OA\Property(property="data_nascimento", type="date", example="1982/07/03"),
     *                  @OA\Property(property="sexo", type="enum", example="feminino"),
     *                  @OA\Property(property="endereco", type="string", example="Rua Alves cardoso 144"),
     *                  @OA\Property(property="uf", type="string", example="SP"),
     *                  @OA\Property(property="created_at", type="date", example="2024-07-09T22:22:07.000000Z"),
     *                  @OA\Property(property="updated_at", type="date", example="2024-07-09T22:22:07.000000Z"),
     *                  @OA\Property(property="deleted_at", type="date", example="null"),
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Wrong error",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean", example="false"),
     *              @OA\Property(property="message", type="string", example="Sorry, wrong error. Please try again")
     *          )
     *      )
     *  )
     */
    public function update(UpdateClienteRequest $request, $id)
    {
        try {

            $data = $this->repository->update($id, $request->validated());
            return response()->json( ['success' => true, 'data' => $data] , 200);
        } catch (\Exception $th) {
             return response()->json( ['success' => false, 'message' => "Validation errors", 'data' => [] ] , 204);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *  @OA\Delete(
     *      path="/cliente/{id}",
     *      summary="Delete cliente",
     *      description="Delete cliente",
     *      operationId="cliente-delete",
     *      tags={"Cliente"},
     *      @OA\Parameter(
     *          description="id",
     *          in="path",
     *          name="id",
     *          required=true,
     *          example="1",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="The resource was deleted successfully",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean", example="true"),
     *              @OA\Property(property="message", type="string", example="The resource was deleted successfully")
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Wrong error",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean", example="false"),
     *              @OA\Property(property="message", type="string", example="Sorry, wrong error. Please try again")
     *          )
     *      ),
     *  )
     */
    public function destroy($id)
    {
        try {
            $data = $this->repository->delete($id);
            return response()->json( ['success' => true, 'data' => $data] , 200);
        } catch (\Exception $th) {
            return response()->json( ['success' => false, 'message' => "Validation errors", 'data' => [] ] , 204);
        }
    }

}
