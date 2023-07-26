<?php

namespace App\Http\Controllers\lab;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use App\Models\Lab;
use Illuminate\Http\Request;

class labController extends Controller
{ use GeneralTrait;
    //
    public function getLab()
    { 
       
        {
            try {
                $lab = Lab::with('image')->get();
                $msg = 'Done';
              
                return $this->successResponse($lab, $msg);
            } catch (\Exception $e) {
                return $this->errorResponse($e->getMessage(), 500);
            }
        }
        
        
    }


}
