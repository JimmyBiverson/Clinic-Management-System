@extends('layouts.app')

@section('title', 'Dashboard — Koyonzo Family Care Clinic')

@section('content')
    @if (auth()->user()->isDoctor())
        @include('dashboard.doctor')
    @else
        @include('dashboard.staff')
    @endif
@endsection