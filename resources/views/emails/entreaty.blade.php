@extends('layouts.email')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Thanks for your Business, {{ $recipient_name }}. Do pay us using paystack now.
                </div>


            </div>

        </div>
    </div>
@endsection
