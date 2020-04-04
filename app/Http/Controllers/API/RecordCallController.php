<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use Validator;
use App\Models\Call;
use Auth;
use App\Http\Resources\RecordCall as RecordCallResource;

class RecordCallController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $calls = Call::where('attended_by',$user['id'])->paginate(10);

        return $this->sendResponse(
            RecordCallResource::collection($calls),
            'Call retrieved successfully.'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $call = Call::create($input);

        return $this->sendResponse(new RecordCallResource($call), 'Product created successfully.');
    }
}
