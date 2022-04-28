<?php

namespace App\Http\Controllers\Source;

use App\Http\Controllers\Controller;
use App\Services\ValidationService;
use App\Services\Gate\ApplicationService;
use Illuminate\Http\Request;

class SourceController extends Controller
{
    protected $applicationService;
    protected $validator;
    protected $request;

    function __construct(ValidationService $validator, ApplicationService $applicationService, Request $request)
    {
        $this->validator = $validator;
        $this->applicationService = $applicationService;
        $this->request = $request;
    }

    public function getSourceAmount()
    {
        $params = $this->request->only('q');
        $result = [];
        $amount= $params['q'];
        if(is_numeric($amount)){
            $result = [
                ['id'=> $amount, 'text'=> number_format($amount, 0, ',', '.')],
                ['id'=> $amount * 10, 'text'=> number_format($amount * 10, 0, ',', '.')],
                ['id'=> $amount * 100, 'text'=> number_format($amount * 100, 0, ',', '.')],
                ['id'=> $amount * 1000, 'text'=> number_format($amount * 1000, 0, ',', '.')],
                ['id'=> $amount * 10000, 'text'=> number_format($amount * 10000, 0, ',', '.')]
            ];
        }
        return response()->json(['items'=> $result, count($result)]);
    }
}
