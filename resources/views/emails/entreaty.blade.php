@extends('layouts.email')

@section('content')

Hello {{ $recipient_name }},

You are to pay &#x20a6;{{ $amount }} for {{ $invoice_title }}.
<p>Details:<br> {!! nl2br(e($invoice_description)) !!}</p>
Click the link below to pay using paystack:

<p><a href="{{ $payment_url }}">{{ $payment_url }}</a>
@endsection
