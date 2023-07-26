<?php

namespace App\Http\Controllers\item;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\traits\GeneralTrait;

/**
 * Summary of itemController
 */
class itemController extends Controller
{
    use GeneralTrait;
    //
    public function getAnalysis()
    {
        try {
            // $items = Item::where('category_id', 1)->get()
            $items = Category::find(1)->items;
            $msg = 'Done';
    
            return $this->successResponse($items, $msg);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    /**
     * Summary of getRadiation
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRadiation()
    {
        try {
            // $items = Item::where('category_id', 2)->get()
            $items = Category::find(2)->items;
            $msg = 'Done';
    
            return $this->successResponse($items, $msg);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
    

}