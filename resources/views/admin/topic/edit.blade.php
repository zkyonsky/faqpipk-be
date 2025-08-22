@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Topik</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-book-open"></i> Edit Topik</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.topic.update', $topic->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label>TOPIK</label>
                            <input type="text" name="name" value="{{ old('name', $topic->name) }}"
                                placeholder="Masukkan Topik"
                                class="form-control @error('name') is-invalid @enderror">


                            @error('name')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>KATEGORI</label>
                            <select class="form-control select-category @error('category_id') is-invalid @enderror"
                                name="category_id">
                                <option value="">-- PILIH KATEGORI --</option>
                                @foreach ($categories as $category)
                                    @if($topic->category_id == $category->id)
                                        <option value="{{ $category->id  }}" selected>{{ $category->name }}</option>
                                    @else
                                        <option value="{{ $category->id  }}">{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('category_id')
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