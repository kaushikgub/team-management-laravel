<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class CountryController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        try {
            $countries = Http::get('https://restcountries.eu/rest/v2/all')->json();
            $countries = collect($countries)->map(function ($country){
                return [
                    'name' => $country['name'] ?? 'N/A',
                    'capital' => $country['capital'] ?? 'N/A'
                ];
            });
            return response()->json([
                'status' => 'success',
                'data' => $countries,
                'message' => 'All Country Data'
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
