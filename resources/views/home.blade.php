@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <i class="fas fa-h1">You are logged in!</i>

                    <ul>
                        @foreach ($todos as $todo)
                        <li>
                            <a href="{{ route('todos.toggle', $todo) }}" style="text-decoration:none;color:#000;">
                                @if ($todo->completed_at) ✔<del> @endif
                                    {{ $todo->text }}
                                @if ($todo->completed_at) </del> @endif
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    <form action="{{ route('todos.store') }}" method="POST">
                        @csrf
                        <input type="text" name="todo">
                        <button type="submit">Ekle</button>
                        @error('todo')
                        <br>
                        {{ $message }}
                        @enderror
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
