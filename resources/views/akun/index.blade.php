@extends('layout.main')
@section('container')
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col">
                    @include('partials.breadcrumb.breadcrumb', ['pageTitle' => $judulHalaman, 'breadcrumbs' => $breadcrumbs])
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <a href="{{ route('akun.create') }}">
                        <button type="button" class="btn btn-info mb-3">
                            Tambah Akun
                        </button>
                    </a>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h2 class="mb-4 text-center">Data Akun</h2>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Alamat</th>
                                            <th>Role</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php
                                            $UserLogin = $user->where('id_user', Auth::id())->first();
                                        @endphp
                                
                                        @if ($UserLogin)
                                            <tr>
                                                <td>1</td>
                                                <td>{{ $UserLogin->username }}</td>
                                                <td>{{ $UserLogin->email }}</td>
                                                <td>{{ $UserLogin->alamat }}</td>
                                                <td>{{ $UserLogin->role }}</td>
                                                <td>
                                                    <span class="text-danger">Tidak tersedia untuk yang sedang login saat ini</span>
                                                </td>
                                            </tr>
                                        @endif

                                        @php
                                            $UserLain = $user->where('id_user', '!=', Auth::id());
                                        @endphp
                                
                                        @foreach ($UserLain as $index => $user)
                                            <tr>
                                                <td>{{ $loop->iteration + 1 }}</td>
                                                <td>{{ $user->username }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->alamat }}</td>
                                                <td>{{ $user->role }}</td>
                                                <td>
                                                    <a href="{{ route('akun.edit', $user->id_user) }}" class="btn btn-success">
                                                        <iconify-icon icon="tabler:pencil" class="fs-6"></iconify-icon>
                                                    </a>
                                                    <a href="{{ route('index.resetPassword', $user->id_user) }}" class="btn btn-warning">
                                                        <iconify-icon icon="tabler:key" class="fs-6"></iconify-icon>
                                                    </a>                                
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteUserModal{{ $user->id_user }}">
                                                        <iconify-icon icon="tabler:trash" class="fs-6"></iconify-icon>
                                                    </button>
                                                    @include('partials.akun.modal_delete_akun')
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection