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