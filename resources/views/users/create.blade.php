@extends('layouts.app')

@section('content')
    <h1>Создание нового пользователя</h1>

    <!-- Показываем ошибки валидации, если они есть -->
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <!-- Поле для имени -->
        <label for="name">Name:</label>
        <input type="text" name="name" value="{{ old('name') }}">
        @error('name')<div>{{ $message }}</div>@enderror

        <!-- Поле для email -->
        <label for="email">Email:</label>
        <input type="email" name="email" value="{{ old('email') }}">
        @error('email')<div>{{ $message }}</div>@enderror

        <!-- Поле для пароля -->
        <label for="password">Password:</label>
        <input type="password" name="password">
        @error('password')<div>{{ $message }}</div>@enderror

        <!-- Поле для роли -->
        <label for="role">Role:</label>
        <input type="text" name="role" value="{{ old('role') }}">
        @error('role')<div>{{ $message }}</div>@enderror

        <button type="submit">Создать</button>
    </form>

    <a href="{{ route('users.index') }}">Назад</a>
@endsection
