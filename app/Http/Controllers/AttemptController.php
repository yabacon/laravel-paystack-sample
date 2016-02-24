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
        // only start a transaction if this entreaty is not yet paid
        if ($entreaty->invoice_paid) {
            return view('attempts/success');
        }
        // Need a Paystack Library object
        $paystackLibObject = Paystack::make();

        // Inititiate transaction, amount should be in kobo
        $getAuthorization = $paystackLibObject->startOneTimeTransaction($entreaty->amount * 100,
                                                                        $entreaty->recipient_email);
        $entreaty->attempts()->create([
            'reference' => $getAuthorization['reference'],
            'status'    => 'initialized',
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
            'trxref' => 'required'
        ]);

        // Need a Paystack Library object
        $paystackLibObject = Paystack::make();

        // Inititiate transaction, amount should be in kobo
        $verifyTransaction = $paystackLibObject->verifyTransaction($request->trxref);

        if ($verifyTransaction) {
            // get attempt for reference
            $attempt = Attempt::where('reference',
                                      $request->trxref)->first();
            $attempt->status = 'successful';
            $attempt->save();

            // get its entreaty and update that entreaty's status to paid
            $entreaty = $attempt->entreaty()->get()->first();
            $entreaty->invoice_paid = true;
            $entreaty->save();
            return view('attempts/success');
        } else {
            $attempt->status = 'failed';
            $attempt->save();
            return view('attempts/failed');
        }
    }
}
