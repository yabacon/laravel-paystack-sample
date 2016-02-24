<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Entreaty;
use App\Repositories\EntreatyRepository;

class EntreatyController extends Controller
{

    /**
     * The entreaty repository instance.
     *
     * @var EntreatyRepository
     */
    protected $entreaties;

    /**
     * Create a new controller instance.
     *
     * @param  EntreatyRepository  $entreaties
     * @return void
     */
    public function __construct(EntreatyRepository $entreaties)
    {
        $this->middleware('auth');

        $this->entreaties = $entreaties;
    }

    /**
     * Display a list of all of the user's entreaties.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('entreaties.index',
                    [
            'entreaties' => $this->entreaties->forUser($request->user()),
        ]);
    }

    /**
     * Create a new entreaty.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {


        $this->validate($request,
                        [
            'recipient_name'      => 'required|max:255',
            'recipient_email'     => 'required|email|max:255',
            'invoice_title'       => 'required|max:255',
            'invoice_description' => 'required',
            'amount'              => 'required|numeric'
        ]);

        $request->user()->entreaties()->create([
            'recipient_name'      => $request->recipient_name,
            'recipient_email'     => $request->recipient_email,
            'invoice_title'       => $request->invoice_title,
            'invoice_description' => $request->invoice_description,
            'amount'              => $request->amount
        ]);

        // Send email to recipient
        Mail::send('emails.entreaty',
                   [
                       'recipient_name' => $request->recipient_name,
                       'amount' => $request->amount,
                       'invoice_title' => $request->invoice_title,
                       'invoice_description' => $request->invoice_description
            ],
                   function($message) use ($request) {
            $message->from('q3@ps.eidetic.ng', 'Sample Laravel App');

            $message->to($request->recipient_email,
                         $request->recipient_name)->cc('ibrahim.lawal@eidetic.ng')->subject('An entreaty to pay!');
        });

        return redirect('/entreaties');
    }

    /**
     * Destroy the given entreaty.
     *
     * @param  Request  $request
     * @param  Entreaty  $entreaty
     * @return Response
     */
    public function destroy(Request $request, Entreaty $entreaty)
    {
        $this->authorize('destroy',
                         $entreaty);

        $entreaty->delete();

        return redirect('/entreaties');
    }
}
