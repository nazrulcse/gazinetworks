@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Create Users</h1>
@stop

@section('content')
    <h4>Name: {{$user->name}}</h4>
    <h4>Email: {{$user->email}}</h4>
    <h4>Phone: {{$user->phone}}</h4>
    <h4>Work Zone: {{$user->work_zone}}</h4>
    <h4>NID: {{$user->nid}}</h4>
    <h4>Address: {{$user->address}}</h4>
    <h4>Salary: {{$user->monthly_salary}}</h4>
@stop