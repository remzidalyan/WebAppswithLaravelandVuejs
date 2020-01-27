@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Todo List</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7">
                            <ul class="list-group">
                                @foreach ($todos as $todo)
                                <li class="list-group-item">
                                    <a href="{{ route('todos.toggle', $todo) }}" style="text-decoration:none;color:#000;">
                                        @if ($todo->completed_at) ✔<del> @endif
                                            {{ $todo->text }}
                                        @if ($todo->completed_at) </del> @endif
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-5">
                            <form action="{{ route('todos.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                  <input type="text" class="form-control" name="todo" placeholder="" aria-describedby="helpId">
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Ekle</button>
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
    </div>
</div>
@endsection