<?php

namespace App\Http\Controllers;

use App\Entry;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $entry = Entry::create($request->except('file', 'filetype'));
        if (!empty($request->input('file'))) {
            $data = $type = '';
            list($type, $data) = explode(';', $request->input('file'));
            list(, $data) = explode(',', $data);
            $data = base64_decode($data);
            $filename = 'entry-'.$entry->id.'.'.$request->input('filetype');
            file_put_contents(storage_path() . '/app/public/entries/'.$filename, $data);
            $entry->file = '/storage/entries/'.$filename;
            $entry->save();
        }
        $html = view('emails.entry')->with(array(
            'entry' => $entry,
            'contest' => $entry->contest
        ))->render();
        $message =  array(
            'html' => $html,
            'subject' => 'Dziękujemy za udział w konkursie',
            'from_email' => 'mail@asd.pl',
            'from_name' => '',
            'to' => array(array(
                    'email' => $entry->email,
                    'type' => 'to'
            )),
            'preserve_recipients' => false
        );
        $async = true;
        \MandrillMail::messages()->send(
            $message, $async
        );
        return $entry;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function show(Entry $entry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function edit(Entry $entry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entry $entry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entry $entry)
    {
        //
    }
}
