<?php

namespace App\Http\Controllers;

use App\Contest;
use Illuminate\Http\Request;

class ContestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->input('finished') == 'true') {
            return $contests = [
            'local' => Contest::where('finished', true)
                ->where('countrywide', false)
                ->get(),
            'global' => Contest::where('finished', true)
                ->where('countrywide', true)
                ->get()
            ];
        }
        return $contests = [
            'local' => Contest::where('finished', false)
                ->where('countrywide', false)
                ->where('date_start', '<=', date('Y-m-d'))
                ->where('date_end', '>=', date('Y-m-d'))
                ->get(),
            'global' => Contest::where('finished', false)
                ->where('countrywide', true)
                ->where('date_start', '<=', date('Y-m-d'))
                ->where('date_end', '>=', date('Y-m-d'))
                ->get()
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function show(Contest $contest)
    {
        if ($contest->finished)
            return false;
        return $contest;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function edit(Contest $contest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contest $contest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contest $contest)
    {
        //
    }
}
