@extends('layouts.app')
@section('content')
<h1>Dashboard</h1>
<div class="row">
    <div class="col-sm-6">
        <div class="card mb-3 showIp">
            <div class="card-header">IP Address</div>
            <div class="card-body">
                <p class="card-text"></p>
                <a href="#" onclick="dashboard.getIp();" class="btn btn-primary">Update</a>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card mb-3 showTimestamp">
            <div class="card-header">Timestamp</div>
            <div class="card-body">
                <p class="card-text"></p>
                <a href="#" onclick="dashboard.getTimestamp();" class="btn btn-primary">Update</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="card mb-3 getDns">
            <div class="card-header">DNS Lookup</div>
            <div class="card-body">
                <form action="{{ url('/network/dns') }}" method="post" autocomplete="off">
                    @csrf
                    <div class="mb-3">
                        <label for="domain">Domain or IP</label>
                        <input type="text" class="form-control" id="domain" name="domain">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card mb-3 showTimestamp">
            <div class="card-header">Timestamp</div>
            <div class="card-body">
                <p class="card-text"></p>
                <a href="#" onclick="dashboard.getTimestamp();" class="btn btn-primary">Update</a>
            </div>
        </div>
    </div>
</div>
@endsection
