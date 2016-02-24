@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="{{ ((count($attempts) > 0) ? 'col-sm-5':'col-sm-offset-2 col-sm-8') }}">
      <div class="panel panel-default">
        <div class="panel-heading">
          Payment Request created at {{ $entreaty->created_at->format('H:ia \o\n M jS, Y') }}
        </div>

        <div class="panel-body">

          <!-- New Payment Request Form -->
          <div class="row">

            <!-- Payment Request Recipient Name -->
            <div class="col-sm-offset-1 col-sm-10">
              <label for="entreaty-recipient_name" class="col-sm-5 control-label">Recipient Name</label>

              <div class="col-sm-7">
                {{ $entreaty->recipient_name }}
              </div>
            </div>

            <!-- Payment Request Recipient Email -->
            <div class="col-sm-offset-1 col-sm-10">
              <label for="entreaty-recipient_email" class="col-sm-5 control-label">Recipient Email</label>

              <div class="col-sm-7">
                {{ $entreaty->recipient_email }}
              </div>
            </div>

            <!-- Payment Request Invoice Title -->
            <div class="col-sm-offset-1 col-sm-10">
              <label for="entreaty-invoice_title" class="col-sm-5 control-label">Invoice Title</label>

              <div class="col-sm-7">
                {{ $entreaty->invoice_title }}
              </div>
            </div>

            <!-- Payment Request Invoice Description -->
            <div class="col-sm-offset-1 col-sm-10">
              <label for="entreaty-invoice_description" class="col-sm-5 control-label">Invoice Description</label>

              <div class="col-sm-7">
                {!! nl2br(e($entreaty->invoice_description)) !!}
              </div>
            </div>

            <!-- Payment Request amount -->
            <div class="col-sm-offset-1 col-sm-10">
              <label for="entreaty-amount" class="col-sm-5 control-label">Amount</label>

              <div class="col-sm-7">
                &#x20a6;{{ number_format($entreaty->amount,2) }}
              </div>
            </div>

            <!-- Back to list Button -->
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-6">
                <a href="{{ url('/entreaties') }}"><button type="" class="btn btn-primary">
                  <i class="fa fa-btn fa-arrow-circle-o-left"></i>Back to List
                  </button></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-7">  <!-- Current Attempts -->
      @if (count($attempts) > 0)
      <div class="panel panel-default">
        <div class="panel-heading">
          Current Attempts
        </div>

        <div class="panel-body">
          <table class="table table-striped attempt-table">
            <thead>
            <th>Reference</th>
            <th>Status</th>
            <th>Time</th>
            </thead>
            <tbody>
              @foreach ($attempts as $attempt)
              <tr>
                <td class="table-text"><div>{{ $attempt->reference }}</div></td>
                <td class="table-text"><div>{{ $attempt->status }}</div></td>
                <td class="table-text"><div>{{ $attempt->created_at->format('H:ia \o\n M jS, Y') }}</div></td>

              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      @endif
    </div>
  </div>
</div>
@endsection
