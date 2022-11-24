@extends('layouts.main')

@section('content')
    @if (session('success'))
    <x-flash type='success' :message="session('success')" />
    @elseif (session('error'))
    <x-flash type='danger' :message="session('error')" />
    @endif

    <div class="card mb-5">
        <div class="card-header">
            <h1>List User</h1>
        </div>
        <div class="card-body">
            {{-- <div class="input-group mb-3 float-end">
                <input type="text" class="form-control-sm" placeholder="Search..." aria-label="Recipient's username" aria-describedby="basic-addon2">
                <span class="input-group-text" id="basic-addon2">Search</span>
            </div> --}}
            <button class="btn btn-warning float-end mx-2" data-bs-toggle="modal" data-bs-target="#importModal">Import XLS</button>
            <div class="modal fade" id="importModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <form action="{{ url('import') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="importModalLabel">Import XLS</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="file" name="file" id="file" required>
                                    @error('file')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary my-3">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <a href="{{ url('export') }}" class="btn btn-info mb-3 float-end">Export XLS</a>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($data as $user)
                        <tr>
                            <th scope="row">{{$loop->index + 1}}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-grid">
        {!! $data->links() !!}
    </div>
@endsection
