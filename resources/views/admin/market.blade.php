@extends('admin.dashboard')

@section('title', 'Market Places eCoopu')

@section('active-market-places', 'active')

@section('content')

@if (session('status'))
<div class="container alert alert-{{ session('classAlert') }} alert-dismissable" data-dismiss="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    {{ session('status') }}
</div>
@endif

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Market Places</div>
                <div class="panel-body">
                 <a href="#"> <span class="pull-right"><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Add Market Place(s)</button></span></a>
                 <div class="row">
                    <div class="col-md-8">

                        <table class="table table-striped">
                            <thead>
                                <td>Name</td>
                                <td>No. of Shops</td>
                                <td>Action</td>
                            </thead>

                            <tbody>

                                @foreach($countries as $market)
                                <tr>
                                    <td>{{ $market->name }}</td>
                                    <td>{{ count($market->shops) }}</td>
                                    <td><a href="/marketplaceremove/{{$market->id}}">  <button class="btn btn-danger">Remove</button></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


 <!-- *** FOOTER ***
 Add Market places modal
 _____________________________________________________________ -->
 <!-- Modal -->

 <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Add Market place</h4>
            </div>
            <div class="modal-body">
             <form class="form-horizontal" role="form" method="POST" action="{{ route('market') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Name</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required="required" placeholder="Germany">
                        @if($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('currency_code') ? ' has-error' : '' }}">
                    <label for="currency_code" class="col-md-4 control-label">Currency Code</label>
                    <div class="col-md-6">
                        <input id="currency_code" type="text" class="form-control" name="currency_code" value="{{ old('currency_code') }}" required="required" placeholder="EUR">
                        @if($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('currency_code') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('currency_symbol') ? ' has-error' : '' }}">
                    <label for="currency_symbol" class="col-md-4 control-label">Currency Symbol</label>
                    <div class="col-md-6">
                        <input id="currency_symbol" type="text" class="form-control" name="currency_symbol" value="{{ old('currency_symbol') }}" required="required" placeholder="€">
                        @if($errors->has('currency_symbol'))
                        <span class="help-block">
                            <strong>{{ $errors->first('currency_symbol') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-add"></i> Add
                        </button>
                    </div>
                </div>
            </form>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>

</div>
</div>

@endsection
