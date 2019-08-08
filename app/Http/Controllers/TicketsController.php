<?php

namespace App\Http\Controllers;
use App\Models\Ticket;
use App\Repositories\TaskRepository;
use Illuminate\Http\Request;
use App\Http\Requests\TicketFormRequest;
use App\Mail\Tiket_Create;
use Illuminate\Support\Facades\Mail;
use App\Repositories\TicketRepository;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ticketCreated;
use Illuminate\Support\Facades\Notification;

class TicketsController extends Controller
{
    use Notifiable;

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = $this->ticketRepository->getAll();
        return view('tickets.index', compact('tickets'));
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
    public function store(TicketFormRequest $request)
    {
        $slug = uniqid();
        $ticket = new Ticket(array(
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'slug' => $slug
        ));

        $ticket->save();

        $data = array(
            'ticket' => $slug,
        );

        $toUser = $request->user();

        // send notification using the "user" model, when the user receives new message
        $toUser->notify(new ticketCreated($ticket));

        Mail::to($request->user())->send(new Tiket_Create($ticket));

        return redirect('/tickets')->with('status', 'Your ticket has been created! Its unique id is: '.$slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $ticket = $this->ticketRepository->find($slug);
        $comments = $ticket->comments()->get();
        return view('tickets.show', compact('ticket', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $ticket = $this->ticketRepository->find($slug);
        return view('tickets.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($slug, TicketFormRequest $request)
    {
        $ticket = $this->ticketRepository->find($slug);
        $ticket->title = $request->get('title');
        $ticket->content = $request->get('content');
        if($request->get('status') != null) {
            $ticket->status = 0;
        } else {
            $ticket->status = 1;
        }
        $ticket->save();
        return redirect(action('TicketsController@edit', $ticket->slug))->with('status', 'The ticket '.$slug.' has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $ticket = $this->ticketRepository->find($slug);
        $ticket->delete();
        return redirect('/tickets')->with('status', 'The ticket '.$slug.' has been deleted!');
    }
}
