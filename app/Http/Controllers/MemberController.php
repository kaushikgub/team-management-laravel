<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use App\Models\Member;
use App\Models\Team;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index($teamId): JsonResponse
    {
        try {
            $members = Member::query()
                ->where('team_id', $teamId)
                ->get();
            return response()->json([
                'status' => 'success',
                'data' => $members,
                'message' => 'All Data'
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
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $teamId
     * @param MemberRequest $request
     * @return JsonResponse
     */
    public function store($teamId, MemberRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            Member::query()->where('team_id', $teamId)->delete();
            Member::query()->insert($request->all());
            DB::commit();
            return response()->json([
                'status' => 'success',
                'data' => null,
                'message' => 'Created Successfully'
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
     * @return Response
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
            $member = Member::query()->findOrFail($id);
            return response()->json([
                'status' => 'success',
                'data' => $member,
                'message' => 'Data'
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
     * @param MemberRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(MemberRequest $request, int $id): JsonResponse
    {
        try {
            $member = Member::query()->find($id)->update($request->all());
            return response()->json([
                'status' => 'success',
                'data' => $member,
                'message' => 'Updated Successfully'
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
     * @param int $teamId
     * @param $memberId
     * @return JsonResponse
     */
    public function destroy(int $teamId, $memberId): JsonResponse
    {
        try {
            Member::query()->find($memberId)->delete();
            return response()->json([
                'status' => 'success',
                'data' => null,
                'message' => 'Deleted Successfully'
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
