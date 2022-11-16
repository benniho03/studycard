<x-app-layout>
    <div class="container mt-3">
        <form method="post" action="{{ url('create-set') }}">
            @csrf
            <div class="row">
                <div class="col-6">
                    <label>Name</label>
                    <input name="name" class="form-control col-6 border" type="text" placeholder="name">
                </div>
                <div class="col-6">
                    <label>Description</label>
                    <input name="description" class="form-control col-6 border" type="text" placeholder="description">
                </div>
            </div>
            <button type="submit" class="btn">Create</button>
            <a href="{{ url('/') }}" class="btn btn-dangerous">Back</a>
        </form>
    </div>

    <div class="container">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>name</th>
                    <th>actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $entry)
                    <tr>
                        <td>{{ $entry->id }}</td>
                        <td>{{ $entry->name }}</td>
                        <td><a class="btn btn-secondary" href="{{url('edit-set')."/".$entry->id}}">Edit</a><a href="{{url('delete-set')."/".$entry->id}}" class="btn btn-danger">Delete</a></td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>