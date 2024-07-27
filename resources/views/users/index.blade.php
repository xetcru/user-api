@extends('layouts.app')

@section('content')
    <h1>Список пользователей</h1>

    <!-- Показ сообщений об успешных операциях -->
    @if (session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    <!-- Форма поиска -->
    <form action="{{ route('users.index') }}" method="GET">
        <input type="text" name="search" value="{{ request()->input('search') }}" placeholder="Поиск пользователей...">
        <button type="submit">Поиск</button>
    </form>

    <!-- Кнопка выхода -->
    <form action="{{ route('logout') }}" method="POST" style="margin-top: 10px;">
        @csrf
        <button type="submit">выход</button>
    </form>

    <!-- Таблица пользователей -->
    @if ($users->count())
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <a href="{{ route('users.show', $user->id) }}">View</a>
                            <a href="{{ route('users.edit', $user->id) }}">Edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Уверен?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Пагинация -->
        <div class="pagination">
            {{ $users->appends(request()->query())->links() }}
        </div>
    @else
        <p>Таких не найдено.</p>
    @endif

    <!-- Ссылка на создание нового пользователя -->
    <a href="{{ route('users.create') }}">Создать нового пользователя</a>
@endsection

<!-- костыль для стилей пагинации -->
<style>
    .pagination span a svg {
        width: 20px;
    }
    .pagination .rounded-md span span svg {
        width: 20px;
    }
</style>
