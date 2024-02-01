<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use Illuminate\Http\Request;

class CarModelController extends Controller
{
    public function index()
    {
        $car_models = CarModel::all();
        return view('index',compact('car_models'));
    }

    public function show($id)
    {
        $car_model = CarModel::findOrFail($id);
        $generationsByMarket = $car_model->generations->groupBy('market');
        return view('show', compact('generationsByMarket'));
    }
}
