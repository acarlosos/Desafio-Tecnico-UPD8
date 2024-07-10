<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCidadeRequest;
use App\Http\Requests\UpdateCidadeRequest;

use App\Repository\CidadeRepository;

class CidadeController extends Controller
{
    private $repository;

    public function __construct(CidadeRepository $repository ) {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @OA\Get(
     * path="/cidade",
     * summary="Return cidades",
     * description="Return cidades",
     * operationId="cidade-index",
     * tags={"Cidade"},
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *       @OA\Property(property="success", type="boolean", example="true"),
        *       @OA\Property(property="data", type="object",
        *           @OA\Property(property="types", type="array",
        *               @OA\Items(
        *                   @OA\Property(property="id", type="integer", example="1"),
        *                   @OA\Property(property="nome", type="string", example="Acrelândia"),
        *                   @OA\Property(property="uf", type="string", example="AC"),
        *                   @OA\Property(property="created_at", type="date", example="2024-07-09T22:22:07.000000Z"),
        *                   @OA\Property(property="updated_at", type="date", example="2024-07-09T22:22:07.000000Z"),
        *                   @OA\Property(property="deleted_at", type="date", example="null"),
        *               )
        *           )
        *       ),
     *        )
     *     ),
     *  @OA\Response(
     *    response=204,
     *    description="Wrong error",
     *    @OA\JsonContent(
     *       @OA\Property(property="success", type="boolean", example="false"),
     *       @OA\Property(property="message", type="string", example="Sorry, wrong error. Please try again")
     *        )
     *     ),
     *  )
     * )
     */
    public function index()
    {
        try {
            $data = $this->repository->index();
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
     *      path="/cidade",
     *      summary="Create cidade",
     *      description="Create cidade",
     *      operationId="cidade-store",
     *      tags={"Cidade"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Create cidade",
     *          @OA\JsonContent(
     *              required={"nome", "uf"},
     *              @OA\Property(property="nome", type="string", example="Campinas"),
     *              @OA\Property(property="uf", type="string", example="SP"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\Property(property="success", type="boolean", example="true"),
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="integer", example="1"),
     *              @OA\Property(property="nome", type="string", example="Campinas"),
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
     *
     */
    public function store(StoreCidadeRequest $request)
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
     *      path="/cidade/{id}",
     *      summary="Return cidades",
     *      description="Return cidades",
     *      operationId="cidade-show",
     *      tags={"Cidade"},
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
     *                  @OA\Property(property="nome", type="string", example="Acrelândia"),
     *                  @OA\Property(property="uf", type="string", example="AC"),
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
     *      path="/cidade/{id}",
     *      summary="Update cidades",
     *      description="Update cidades",
     *      operationId="cidade-update",
     *      tags={"Cidade"},
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
     *          description="Update cidade",
     *          @OA\JsonContent(
     *              required={"nome", "uf"},
     *              @OA\Property(property="nome", type="string", example="Acrelândia"),
     *              @OA\Property(property="uf", type="string", example="AC"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean", example="true"),
     *              @OA\Property(property="data", type="object",
     *                  @OA\Property(property="id", type="integer", example="1"),
     *                  @OA\Property(property="nome", type="string", example="Acrelândia"),
     *                  @OA\Property(property="uf", type="string", example="AC"),
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
    public function update(UpdateCidadeRequest $request, $id)
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
     *      path="/cidade/{id}",
     *      summary="Delete cidade",
     *      description="Delete cidade",
     *      operationId="cidade-delete",
     *      tags={"Cidade"},
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
