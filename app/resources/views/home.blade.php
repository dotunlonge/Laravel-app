@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('/sms/send') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">From</label>

                            <div class="col-md-6">
                                <input id="sender" type="text" class="form-control" name="sender" placeholder="E.g Your Name" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="num" class="col-md-4 control-label">To</label>

                            <div class="col-md-6">
                                <input id="num" type="text" class="form-control" name="num" placeholder = "E.g 08123456789" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Message</label>

                            <div class="col-md-6">
                                <textarea id="msg" class="form-control" name="msg" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="isflash"> is Flash ?
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Send
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
