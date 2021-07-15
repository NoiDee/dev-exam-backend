<?php

namespace App\Http\Controllers;

use App\Models\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class ApiResponseController extends Controller
{

    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        return ApiResponse::all();
    }    

    /**
     * Store new resource from third party
     *
     * @return \Illuminate\Http\Response
     */
    public function fromThirdparty() 
    {
        $response = Http::get('http://node:3000/api/datetime');
        $content = json_decode($response->body());
        $dateTime = Carbon::parse($content->date_time)->setTimezone('UTC');
        $httpResponse = $this->fixNestedArray($response->headers());
        return ApiResponse::create([
            'date_time' =>  $dateTime, 
            'http_response' => $httpResponse
        ]);
    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date_time' => 'required',
            'http_response' => 'required'
        ]);
        return ApiResponse::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) 
    {
        return ApiResponse::find($id);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update($request, $id) 
    {
        $apiResp = ApiResponse::find($id);
        $apiResp->update($request->all());
        return $apiResp;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return ApiResponse::destroy($id);
    }

    /**
     * Convert nested array into string
     *  
     * @param  array $arr
     * @return array
     */
    private function fixNestedArray($arr) 
    {
        $newArr = [];
        foreach ($arr as $key => $value) {
            $newArr[$key] = $value[0];
        }
        return $newArr;
    }
}
