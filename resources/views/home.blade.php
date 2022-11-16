<x-app-layout>
    <div class="container">
        <div class="row mt-3">
            <div class="col d-flex justify-content-center">
                <h1 class="h1">Studycard</h1>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-8 card-container d-grid place-items-center border border-3 border-dark p-5">
                <p class="fs-3 text-center" id="card-text">Hi</p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-4 d-flex justify-content-end">
                <button id="right-button" class="btn btn-success">We lit</button>
            </div>
            <div class="col-4 d-flex justify-content-center">
                <button id="show-button" class="btn btn-secondary">Check</button>
            </div>
            <div class="col-4 d-flex justify-content-start">
                <button id="wrong-button" class="btn btn-danger">Big L</button>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('#show-button').on('click', $(this).ajax({
            type: 'get',
            url: '{{URL::to('search')}}',
            data:{'search':$id}
        }))
    </script>
</x-app-layout>
