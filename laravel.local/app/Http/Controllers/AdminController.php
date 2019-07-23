<?php
/**
 * Created by : alex
 * Date: 21.07.19
 * Time: 19:56
 */

namespace App\Http\Controllers;


class AdminController extends Controller
{
    public function index()
    {
        return view('welcome_admin');
    }
}