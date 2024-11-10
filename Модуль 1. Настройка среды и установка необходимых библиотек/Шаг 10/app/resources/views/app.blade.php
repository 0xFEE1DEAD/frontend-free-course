<form action="/" method="POST">
    <label for="content">Msg</label>
    <input id="content" name="content">

    <ul>
    @forelse(app('db')->select("SELECT * FROM records") as $record)
        <li>{{ $record->content }}</li> 
    @empty
        <li>Нет записей</li>
    @endforelse
    </ul>
</form>