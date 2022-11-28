@extends('layouts.app')
@section('title')
    Rates
@endsection
@section('content')
    <div class="container">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Rate List</div>
                    <div class="card-body">
                        <table class="table table-striped table-hover table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Fat</th>
                                    <th scope="col">SNF</th>
                                    <th scope="col">Rate</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rates as $rate)
                                    <tr>
                                        <th scope="row">{{ $rate->fat }}</th>
                                        <td>{{ $rate->snf }}</td>
                                        <td>₹ {{ $rate->rate }}</td>
                                        <td>
                                            <a href="#" class="me-1" data-bs-toggle="modal"
                                                    data-bs-target="#editRate" data-bs-id="{{ $rate->id }}"
                                                    data-bs-fat="{{ $rate->fat }}"><i data-feather="edit" width="16px"
                                                        height="16px"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $rates->links() }}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Add New Rate</div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="mb-2 form-floating">
                                <input type="text" id="fat" name="fat" class="form-control" placeholder="Fat">
                                <label for="fat">Fat</label>
                            </div>
                            <div class="mb-2 form-floating">
                                <input type="text" id="snf" name="snf" class="form-control" placeholder="SNF"
                                    value="8.50">
                                <label for="snf">SNF</label>
                            </div>
                            <div class="mb-2 form-floating">
                                <input type="text" id="rate" name="rate" class="form-control" placeholder="₹ Rate">
                                <label for="rate">₹ Rate</label>
                            </div>
                            @csrf
                            <div class="d-grid gap-3">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editRate" tabindex="-1" aria-labelledby="editRateLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editRateLabel">Edit Rate For Fat <span id="fatNo">3.0</span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="editRate">
                        @method('PUT')
                        <div class="mb-2 form-floating">
                            <input type="text" id="fat" name="fat" class="form-control" placeholder="Fat">
                            <label for="fat">Fat</label>
                        </div>
                        <div class="mb-2 form-floating">
                            <input type="text" id="snf" name="snf" class="form-control" placeholder="SNF">
                            <label for="snf">SNF</label>
                        </div>
                        <div class="mb-2 form-floating">
                            <input type="text" id="rate" name="rate" class="form-control" placeholder="₹ Rate">
                            <label for="rate">₹ Rate</label>
                        </div>
                        @csrf
                        <div class="d-grid gap-3">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const editRate = document.getElementById('editRate')
        editRate.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget
            // Extract info from data-bs-* attributes
            const rateId = button.getAttribute('data-bs-id')
            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            // Creating Our XMLHttpRequest object 
            var xhr = new XMLHttpRequest();

            // Making our connection  
            var url = `{{ route('rate.index') }}/${rateId}`
            xhr.open("GET", url, true)
            const fatInput = editRate.querySelector('#fat')
            const snfInput = editRate.querySelector('#snf')
            const rateInput = editRate.querySelector('#rate')
            const editForm = editRate.querySelector('#editRate')
            // function execute after request is successful 
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    fatTitle.textContent = JSON.parse(this.responseText).fat
                    fatInput.value = JSON.parse(this.responseText).fat
                    snfInput.value = JSON.parse(this.responseText).snf
                    rateInput.value = JSON.parse(this.responseText).rate
                    editForm.action = `{{ route('rate.index') }}/${rateId}/edit`
                }
            }
            // Sending our request 
            xhr.send();
            // Update the modal's content.
            const fatTitle = editRate.querySelector('#fatNo')
        })
    </script>
@endsection
