@extends('layouts.app')

@section('content')
<app account-id="{{Auth::user()->account_id}}" account-name="{{Auth::user()->account_name}}" role="{{Auth::user()->role}}"></app>
@endsection
