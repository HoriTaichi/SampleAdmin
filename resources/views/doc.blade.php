@extends('layouts.app_doc')

@section('content')
<doc-customize account-id="{{Auth::user()->account_id}}" account-name="{{Auth::user()->account_name}}" role="{{Auth::user()->role}}"></doc-cust>
@endsection
