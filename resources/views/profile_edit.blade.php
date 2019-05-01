@extends('layouts.app')

@section('content')
    <form method="POST" action="{{route('profile.update_info')}}">
        @csrf
        <label>First name</label>
        <input type="text" name="first_name" value="{{$user->first_name}}">

        <label>Last name</label>
        <input type="text" name="last_name" value="{{$user->last_name}}">

        <label>Email</label>
        <input type="text" name="email" value="{{$user->email}}">

        <button type="submit">Submit</button>
    </form>

    <form method="POST" action="{{route('profile.update_password')}}">
        @csrf
        <label>Old password</label>
        <input type="password" name="old_password">

        <label>New password</label>
        <input type="password" name="password">

        <label>Confirm new password</label>
        <input type="password" name="password_confirmation">

        <button type="submit">Submit</button>
    </form>


@endsection