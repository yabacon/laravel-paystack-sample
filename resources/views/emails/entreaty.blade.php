@extends('layouts.email')

@section('content')

Thanks for your Business, {{ $recipient_name }}. You need to pay us &#x20a6;{{ $amount }} for {{ $invoice_title }}.
<p>Details: {!! nl2br(e($invoice_description)) !!}</p>
Do pay us using paystack now.

@endsection
