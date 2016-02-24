@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="{{ ((count($attempts) > 0) ? 'col-sm-5':'col-sm-offset-2 col-sm-8') }}">
      <div class="panel panel-default">
        <div class="panel-heading">
          Entreaty created at {{ $entreaty->created_at->format('H:ia \o\n M j, Y') }}
        </div>

        <div class="panel-body">

          <!-- New Entreaty Form -->
          <div class="row">

            <!-- Entreaty Recipient Name -->
            <div class="col-sm-offset-1 col-sm-10">
              <label for="entreaty-recipient_name" class="col-sm-5 control-label">Recipient Name</label>

              <div class="col-sm-7">
                {{ $entreaty->recipient_name }}
              </div>
            </div>

            <!-- Entreaty Recipient Email -->
            <div class="col-sm-offset-1 col-sm-10">
              <label for="entreaty-recipient_email" class="col-sm-5 control-label">Recipient Email</label>

              <div class="col-sm-7">
                {{ $entreaty->recipient_email }}
              </div>
            </div>

            <!-- Entreaty Invoice Title -->
            <div class="col-sm-offset-1 col-sm-10">
              <label for="entreaty-invoice_title" class="col-sm-5 control-label">Invoice Title</label>

              <div class="col-sm-7">
                {{ $entreaty->invoice_title }}
              </div>
            </div>

            <!-- Entreaty Invoice Description -->
            <div class="col-sm-offset-1 col-sm-10">
              <label for="entreaty-invoice_description" class="col-sm-5 control-label">Invoice Description</label>

              <div class="col-sm-7">
                {!! nl2br(e($entreaty->invoice_description)) !!}
              </div>
            </div>

            <!-- Entreaty amount -->
            <div class="col-sm-offset-1 col-sm-10">
              <label for="entreaty-amount" class="col-sm-5 control-label">Amount</label>

              <div class="col-sm-7">
                &#x20a6;{{ number_format($entreaty->amount,2) }}
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
            <th>Attempt</th>
            <th>&nbsp;</th>
            </thead>
            <tbody>
              @foreach ($attempts as $attempt)
              <tr>
                <td class="table-text"><div>{{ $attempt->recipient_name }}</div></td>

                <!-- Attempt Delete Button -->
                <td>
                  <a href="/attempt/{{ $attempt->id }}"><button type="submit" id="view-attempt-{{ $attempt->id }}" class="btn btn-info">
                      <i class="fa fa-btn fa-eye"></i>View
                    </button></a>

                  <form class="{{ ($attempt->invoice_paid ? 'hidden':'') }}" style="display:inline-block" action="/attempt/{{ $attempt->id }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button type="submit" id="delete-attempt-{{ $attempt->id }}" class="btn btn-danger">
                      <i class="fa fa-btn fa-trash"></i>Delete
                    </button>
                  </form>
                </td>
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
