<?php

namespace App\Http\Controllers;

//use Illuminate\Support\Facades\Log;
use App\Models\Log as LogEntry;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index()
    {
        $data = LogEntry::with('user')->get();
        //Log::info($data);
        return view('page.log.index', compact('data'));
    }
}
