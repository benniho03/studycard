<x-app-layout>
    <div class="container mt-3">
        @if (Session::has('success'))
            <div class="alert alert-succes" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <form method="post" action="{{ url('update-card') }}">
            @csrf
            <input type="hidden" name='id' value='{{$data->cardID}}'>
            <div class="row">
                <div class="col-6">
                    <label>Question</label>
                    <input name="question" class="form-control col-6 border" type="text" placeholder="Question" value={{$data->question}}>
                </div>
                <div class="col-6">
                    <label>Answer</label>
                    <input name="answer" class="form-control col-6 border" type="text" placeholder="Answer" value={{$data->answer}}>
                </div>
                <div class="col-6">
                    <label>Set</label>
                    <input name="set" class="form-control col-6 border" type="text" placeholder="Set" value={{$data->set}}>
                </div>
            </div>
            <button type="submit" class="btn">Apply</button>
            <a href="{{ url('/create-card') }}" class="btn btn-dangerous">Back</a>
        </form>
    </div>
    @php
    echo $data;
@endphp
</x-app-layout>