@extends('layouts.app')

@section('content')
    <h1>Редактирование пользователя</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}">
        @error('name')<div>{{ $message }}</div>@enderror

        <label for="email">Email:</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}">
        @error('email')<div>{{ $message }}</div>@enderror

        <label for="role">Role:</label>
        <input type="text" name="role" value="{{ old('role', $user->role) }}">
        @error('role')<div>{{ $message }}</div>@enderror

        <label for="password">Password:</label>
        <input type="password" name="password">
        @error('password')<div>{{ $message }}</div>@enderror

        <button type="submit">Обновить</button>
    </form>
    <a href="{{ route('users.index') }}">Назад</a>
@endsection
