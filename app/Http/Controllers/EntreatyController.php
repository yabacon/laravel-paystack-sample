<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entreaty;
use App\Repositories\EntreatyRepository;
use Illuminate\Routing\UrlGenerator;

class EntreatyController extends Controller
{

    /**
     * The entreaty repository instance.
     *
     * @var EntreatyRepository
     */
    protected $entreaties;
    protected $url;

    /**
     * Create a new controller instance.
     *
     * @param  EntreatyRepository  $entreaties
     * @return void
     */
    public function __construct(EntreatyRepository $entreaties, UrlGenerator $url)
    {
        $this->middleware('auth');
        $this->url = $url;
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

        $entreaty = $request->user()->entreaties()->create([
            'recipient_name'      => $request->recipient_name,
            'recipient_email'     => $request->recipient_email,
            'invoice_title'       => $request->invoice_title,
            'invoice_description' => $request->invoice_description,
            'amount'              => $request->amount
        ]);

        // Send email to recipient
        Mail::send('emails.entreaty',
                   [
            'recipient_name'      => $request->recipient_name,
            'amount'              => $request->amount,
            'invoice_title'       => $request->invoice_title,
            'invoice_description' => $request->invoice_description,
            'payment_url'         => $this->url->to('/pay/entreaty/' . $entreaty->id)
            ],
                                                    function($message) use ($request) {
            $message->from($request->user()->email, $request->user()->name);

            $message->to($request->recipient_email,
                         $request->recipient_name)->subject(env('MAIL_SUBJECT', 'Payment request'));
        });

        return redirect($this->url->to('/entreaties'));
    }

    /**
     * View the given entreaty.
     *
     * @param  Request  $request
     * @param  Entreaty  $entreaty
     * @return Response
     */
    public function view(Request $request, Entreaty $entreaty)
    {

        return view('entreaties.single',
                    [
            'entreaty' => $entreaty,
            'attempts' => $entreaty->attempts()->get()
        ]);
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

        return redirect($this->url->to('/entreaties'));
    }
}
