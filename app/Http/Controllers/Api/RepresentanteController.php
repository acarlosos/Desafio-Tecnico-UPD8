<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRepresentanteRequest;
use App\Http\Requests\UpdateRepresentanteRequest;
use App\Repository\RepresentanteRepository;
use Illuminate\Http\Request;

class RepresentanteController extends Controller
{
    private $repository;

    public function __construct(RepresentanteRepository $repository ) {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @OA\Get(
     * path="/representante",
     * summary="Return representantes",
     * description="Return representantes",
     * operationId="representante-index",
     * tags={"Representante"},
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *       @OA\Property(property="success", type="boolean", example="true"),
        *       @OA\Property(property="data", type="object",
        *           @OA\Property(property="types", type="array",
        *               @OA\Items(
        *                   @OA\Property(property="id", type="integer", example="1"),
        *                   @OA\Property(property="nome", type="string", example="Lucas Oliveira"),
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
     *      path="/representante",
     *      summary="Create representante",
     *      description="Create representante",
     *      operationId="representante-store",
     *      tags={"Representante"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Create representante",
     *          @OA\JsonContent(
     *              required={"nome", "uf", "cidade_id"},
     *              @OA\Property(property="cidade_id", type="integer", example="1"),
     *              @OA\Property(property="nome", type="string", example="Lucas Oliveira"),
     *              @OA\Property(property="uf", type="string", example="SP"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\Property(property="success", type="boolean", example="true"),
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="integer", example="1"),
     *              @OA\Property(property="nome", type="string", example="Lucas Oliveira"),
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
    public function store(StoreRepresentanteRequest $request)
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
     *      path="/representante/{id}",
     *      summary="Return representantes",
     *      description="Return representantes",
     *      operationId="representante-show",
     *      tags={"Representante"},
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
     *                  @OA\Property(property="nome", type="string", example="Maria Eduarda"),
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
     *      path="/representante/{id}",
     *      summary="Update representantes",
     *      description="Update representantes",
     *      operationId="representante-update",
     *      tags={"Representante"},
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
     *          description="Update representante",
     *          @OA\JsonContent(
     *              required={"cidade_id","nome", "uf"},
     *              @OA\Property(property="cidade_id", type="integer", example="1"),
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
    public function update(UpdateRepresentanteRequest $request, $id)
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
     *      path="/representante/{id}",
     *      summary="Delete representante",
     *      description="Delete representante",
     *      operationId="representante-delete",
     *      tags={"Representante"},
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
