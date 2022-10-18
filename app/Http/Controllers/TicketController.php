<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
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
        return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'customer_name' => 'required|min:3|max:200', //|unique:user,username
           'email' => 'required|email',
           'description' => 'required', 
        ]);
        

        $ticket = new Ticket();
        
        $ticket->customer_name = $request->input('customer_name');
        $ticket->email = $request->input('email');
        $ticket->phone = $request->input('phone');
        $ticket->description = $request->input('description');
        $ticket->ref = sha1(time());
        $ticket->status = 0;


        if ($ticket->save()){
            //send mail
            Mail::to($ticket->email)->send(new \App\Mail\TicketCreated($ticket));

            return redirect(route('tickets.show', $ticket->id))
            ->with('success', 'Your ticket is created succesfully !. Please write down the reference number to check the ticket status later.');

        }

        return redirect()->back()->with('error', 'Oops! Could not create your ticket . Please try later');
    
        if ($ticket->save()) {
            // Send the email to customer
            Mail::to($ticket->email)->send(new \App\Mail\TicketCreated($ticket));
  
            return redirect(route('tickets.show', $ticket->id))
                ->with('success', 'Your ticket is created successfully. Please write down the reference number to check the ticket status later.');
        }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        return view('tickets.show', [
            'ticket' => $ticket,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    public function search(Request $request)
{
    $ticket = Ticket::where('ref', $request->query('reference'))->first();

    if ($ticket) {
        return redirect(route('tickets.show', $ticket->id));
    }

    return redirect()->back()->with('error', 'Sorry! We could not find the ticket you are looking for. Please check the reference number.');
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}