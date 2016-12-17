@extends('admin.dashboard')

@section('content')

@if (session('status'))
<div class="container alert alert-success text-center">
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
                                <td>Action</td>
                            </thead>

                            <tbody>

                                @foreach($countries as $market)
                                <tr>
                                    <td>{{ $market->name }}</td>
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
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Name</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                        @if($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
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
