<x-app-layout>
    <div class="container mt-3">
        @if (Session::has('success'))
            <div class="alert alert-succes" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <form method="post" action="{{ url('update-set') }}">
            @csrf
            <input type="hidden" name='id' value='{{$data->id}}'>
            <div class="row">
                <div class="col-6">
                    <label>Name</label>
                    <input name="name" class="form-control col-6 border" type="text" placeholder="Name" value={{$data->name}}>
                </div>
            </div>
            <button type="submit" class="btn btn-primary bg-primary">Apply</button>
            <a href="{{ url('/create-set') }}" class="btn btn-dangerous">Back</a>
        </form>
    </div>
</x-app-layout>