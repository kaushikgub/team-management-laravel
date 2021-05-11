<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamRequest;
use App\Models\Team;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $teams = Team::all();
            return response()->json([
                'status' => 'success',
                'data' => $teams,
                'message' => 'All Team Data'
            ], Response::HTTP_OK);
        } catch (\Exception $exception){
            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => $exception->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * @param TeamRequest $request
     * @return JsonResponse
     */
    public function store(TeamRequest $request): JsonResponse
    {
        try {
            $team = Team::query()->create($request->all());
            return response()->json([
                'status' => 'success',
                'data' => $team,
                'message' => 'Team Created Successfully'
            ], Response::HTTP_CREATED);
        } catch (\Exception $exception){
            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => $exception->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function edit(int $id): JsonResponse
    {
        try {
            $team = Team::query()->findOrFail($id);
            return response()->json([
                'status' => 'success',
                'data' => $team,
                'message' => 'Team Data'
            ], Response::HTTP_OK);
        } catch (\Exception $exception){
            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => $exception->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TeamRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(TeamRequest $request, int $id): JsonResponse
    {
        try {
            $team = Team::query()->find($id)->update($request->all());
            return response()->json([
                'status' => 'success',
                'data' => $team,
                'message' => 'Team Updated Successfully'
            ], Response::HTTP_OK);
        } catch (\Exception $exception){
            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => $exception->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            Team::query()->find($id)->delete();
            return response()->json([
                'status' => 'success',
                'data' => null,
                'message' => 'Team Deleted Successfully'
            ], Response::HTTP_OK);
        } catch (\Exception $exception){
            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => $exception->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
