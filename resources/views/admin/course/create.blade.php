@extends('layouts.app')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Course</h1>
            </div>

            <div class="section-body">

                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-book-open"></i> Tambah Course</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.course.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label>NAMA</label>
                                <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan Course" class="form-control @error('name') is-invalid @enderror">

                                @error('name')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>KLUSTER</label>
                                <select class="form-control select-cluster @error('cluster_id') is-invalid @enderror" name="cluster_id">
                                    <option value="">-- PILIH KLUSTER --</option>
                                    @foreach ($clusters as $cluster)
                                        <option value="{{ $cluster->id }}">{{ $cluster->name }}</option>
                                    @endforeach
                                </select>
                                @error('cluster_id')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>LINK</label>
                                <input type="text" name="address" value="{{ old('address') }}" placeholder="Masukkan Course" class="form-control @error('address') is-invalid @enderror">

                                @error('address')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i> SIMPAN</button>
                            <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

@stop