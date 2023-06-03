@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Profil</div>


                <div class="card-body">
                    <div class="row mb-2">
                        @if (\Session::has('message'))
                            <div class="alert alert-success">
                                {!! \Session::get('message') !!}
                            </div>
                        @elseif(\Session::has('error'))
                            <div class="alert alert-danger">
                                {!! \Session::get('error') !!}
                            </div>
                        @endif
                    </div>
                    <form method="POST" action="{{ url('simpan_edit_profil') }}" enctype="multipart/form-data">
                        @csrf
                        @foreach($data_user as $row)
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Nama</label>


                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name"
                                    value="{{ $row->name }}" required autocomplete="name" autofocus>
                            </div>
                        </div>                                                


                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>


                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="{{ $row->email }}"
                                    required autocomplete="email" autofocus>
                            </div>
                        </div>
                        
                        
                        <div class="row mb-3">
                            <label for="no_telp_pemesan" class="col-md-4 col-form-label text-md-end">No HP</label>


                            <div class="col-md-6">
                                <input id="no_telp_pemesan" type="text" class="form-control" name="no_telp_pemesan" value="{{ $row->no_telp_pemesan }}"
                                    required autocomplete="no_telp_pemesan" autofocus>
                            </div>
                        </div>                        


                        <div class="row mb-3">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                            </div>
                        </div>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
