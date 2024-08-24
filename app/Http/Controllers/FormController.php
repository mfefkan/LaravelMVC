<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Country;
use App\Models\Province;
use App\Models\District;
use Illuminate\Http\Request;

class FormController extends Controller
{ 
    public function saveData(Request $request)
    {  
        $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'surname' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:new_users,email',
        'country_id' => 'required|exists:countries,id',
        'province_id' => 'required|exists:provinces,id',
        'district_id' => 'required|exists:districts,id',
    ]);
 
    try { 
        $user = User::create([
            'name' => $validatedData['name'],
            'surname' => $validatedData['surname'],
            'email' => $validatedData['email'],
            'country' => $validatedData['country_id'],
            'province' => $validatedData['province_id'],
            'district' => $validatedData['district_id'],
        ]);
 
        dd($user);

    } catch (\Exception $e) { 
        dd('Veriler kaydedilemedi: ' . $e->getMessage());
    }
    
    }
 
    public function getProvinces($countryId)
    {
        $provinces = Province::where('country_id', $countryId)->get();
        return response()->json($provinces);
    }
 
    public function getDistricts($provinceId)
    {
        $districts = District::where('province_id', $provinceId)->get();
        return response()->json($districts);
    }

    public function showForm()
    { 
         $countries = Country::all();
         return view('form', ['countries' => $countries]);
    }
}
