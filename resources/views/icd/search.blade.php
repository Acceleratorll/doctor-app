    <form action="{{ route('icd.search') }}" method="POST">
        @csrf
        <input class="form-control" type="text" name="term" placeholder="Enter search term"> <br>
        <button class="btn btn-primary" type="submit">Search</button>
    </form>