<?php

namespace App\Http\Controllers;

use MAbiola\Paystack\Paystack;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Attempt;
use App\Entreaty;
use App\Repositories\AttemptRepository;

class AttemptController extends Controller
{

    /**
     * The attempt repository instance.
     *
     * @var AttemptRepository
     */
    protected $attempts;

    /**
     * Create a new controller instance.
     *
     * @param  AttemptRepository  $attempts
     * @return void
     */
    public function __construct(AttemptRepository $attempts)
    {
        $this->attempts = $attempts;
    }

    /**
     * Create a new attempt.
     *
     * @param  Request  $request
     * @return Response
     */
    public function initiate(Request $request, Entreaty $entreaty)
    {
        // Need a Paystack Library object
        $paystackLibObject = Paystack::make();

        // Inititiate transaction, amount should be in kobo
        $getAuthorization = $paystackLibObject->startOneTimeTransaction($entreaty->amount*100,
                                                                        $entreaty->recipient_email);

        $entreaty->attempts()->create([
            'reference'      => $getAuthorization['reference'],
            'status'     => 'initialized',
        ]);

        return redirect($getAuthorization['authorization_url']);
    }

    /**
     * Destroy the given attempt.
     *
     * @param  Request  $request
     * @param  Attempt  $attempt
     * @return Response
     */
    public function verify(Request $request)
    {

        $this->validate($request,
                        [
            'reference'      => 'required'
        ]);

        // Need a Paystack Library object
        $paystackLibObject = Paystack::make();

        // Inititiate transaction, amount should be in kobo
        $verifyTransaction = $paystackLibObject->verifyTransaction($request->reference);

        if($verifyTransaction){
            // get attempt for reference
            $attempt = Attempt::where('reference', $request->reference)->first();
            // get its entreaty and update that entreaty's status to paid
            var_dump( $attempt->entreaty());
            $attempt->entreaty()->invoice_paid=true;
            $attempt->entreaty()->save();
        }

        return view('welcome');
    }
}
