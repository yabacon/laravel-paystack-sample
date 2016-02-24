@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Request payments</div>

                <div class="panel-body">
                  <p>Welcome to a Sample Application
                     using <a href="http://github.com/malikabiola">Malik Abiola</a>'s
                     <a href="https://packagist.org/packages/mabiola/paystack-php-lib">Paystack PHP library</a> to
                   send payment requests to your customers so that they may pay you easily using their paystack keys.

                   <p>As this is not production-ready, you will note that anyone can register and request payments.
                   <p>An updated version may include logic to allow enable or disable users's payment request rights
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
