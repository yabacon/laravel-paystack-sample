@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Entreaty
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Entreaty Form -->
                    <form action="/entreaty" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Entreaty Recipient Name -->
                        <div class="form-group">
                            <label for="entreaty-recipient_name" class="col-sm-3 control-label">Recipient Name</label>

                            <div class="col-sm-6">
                                <input type="text" name="recipient_name" id="entreaty-recipient_name" class="form-control" value="{{ old('recipient_name') }}">
                            </div>
                        </div>

                        <!-- Entreaty Recipient Email -->
                        <div class="form-group">
                            <label for="entreaty-recipient_email" class="col-sm-3 control-label">Recipient Email</label>

                            <div class="col-sm-6">
                                <input type="text" name="recipient_email" id="entreaty-recipient_email" class="form-control" value="{{ old('recipient_email') }}">
                            </div>
                        </div>

                        <!-- Entreaty Invoice Title -->
                        <div class="form-group">
                            <label for="entreaty-invoice_title" class="col-sm-3 control-label">Invoice Title</label>

                            <div class="col-sm-6">
                                <input type="text" name="invoice_title" id="entreaty-invoice_title" class="form-control" value="{{ old('invoice_title') }}">
                            </div>
                        </div>

                        <!-- Entreaty Invoice Description -->
                        <div class="form-group">
                            <label for="entreaty-invoice_description" class="col-sm-3 control-label">Invoice Description</label>

                            <div class="col-sm-6">
                              <textarea name="invoice_description" id="entreaty-invoice_description" class="form-control">{{ old('invoice_description') }}</textarea>
                            </div>
                        </div>

                        <!-- Entreaty amount -->
                        <div class="form-group">
                            <label for="entreaty-amount" class="col-sm-3 control-label">Amount</label>

                            <div class="col-sm-6">
                              <input type="number" name="amount" id="entreaty-amount" class="form-control" value="{{ old('amount') }}">
                            </div>
                        </div>

                        <!-- Add Entreaty Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Make Entreaty
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Entreaties -->
            @if (count($entreaties) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current Entreaties
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped entreaty-table">
                            <thead>
                                <th>Entreaty</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($entreaties as $entreaty)
                                    <tr>
                                        <td class="table-text"><div>{{ $entreaty->recipient_name }}</div></td>

                                        <!-- Entreaty Delete Button -->
                                        <td>
                                            <form action="/entreaty/{{ $entreaty->id }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" id="delete-entreaty-{{ $entreaty->id }}" class="btn btn-danger">
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
@endsection
