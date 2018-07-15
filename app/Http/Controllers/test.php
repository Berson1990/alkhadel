<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Magyarjeti\LaravelLipsum as faker;
class test extends Controller {

    public function test(){

        return view('test');


	}

}
