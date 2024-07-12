<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $response = json_decode(file_get_contents('https://random-data-api.com/api/v2/users?size=100'));

        $quant= count($response);
         
        return view('home', compact('quant'));
    }
   
    
    public function listar(Request $request)
    {
        $data = json_decode(file_get_contents('https://random-data-api.com/api/v2/users?size=100'));

        return Datatables::of($data)
        ->addColumn('username', function($data)
        {
            return  $data->last_name;
        })
        ->addColumn('first_name', function($data)
        {
            return  $data->first_name;
        })
        ->addColumn('last_name', function($data)
        {
            return  $data->last_name;
        })
    
        ->addColumn('email', function($data)
        {
            return $data->email;
        })
        ->addColumn('gender', function($data)
        {
            return $data->gender;
        })
        ->addColumn('phone_number', function($data)
        {
            return $data->phone_number;
        })
        ->addColumn('social_insurance_number', function($data)
        {
            return $data->social_insurance_number;
        })
        ->addColumn('date_of_birth', function($data)
        {
            return date('d-m-Y', strtotime($data->date_of_birth));
        })
        ->make(true);
    }
}