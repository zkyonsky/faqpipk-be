@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Course</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-book-open"></i> Edit Course</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.course.update', $course->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label>COURSE</label>
                            <input type="text" name="name" value="{{ old('name', $course->name) }}"
                                placeholder="Masukkan Course"
                                class="form-control @error('name') is-invalid @enderror">


                            @error('name')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>KLUSTER</label>
                            <select class="form-control select-cluster @error('cluster_id') is-invalid @enderror"
                                name="cluster_id">
                                <option value="">-- PILIH KLUSTER --</option>
                                @foreach ($clusters as $cluster)
                                    @if($course->cluster_id == $cluster->id)
                                        <option value="{{ $cluster->id  }}" selected>{{ $cluster->name }}</option>
                                    @else
                                        <option value="{{ $cluster->id  }}">{{ $cluster->name }}</option>
                                    @endif
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
                            <input type="text" name="address" value="{{ old('address', $course->address) }}"
                                placeholder="Masukkan Link"
                                class="form-control @error('name') is-invalid @enderror">


                            @error('address')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i>
                            UPDATE</button>
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

@stop