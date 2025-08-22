@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Permasalahan</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-book-open"></i> Edit Permasalahan</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.problem.update', $problem->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                                           
                        <div class="form-group">
                            <label>PERMASALAHAN</label>
                            <textarea class="form-control name @error('name') is-invalid @enderror" name="name"
                                placeholder="Masukkan Isi Permasalahan"
                                rows="10">{!! old('solution', $problem->name) !!}</textarea>
                            @error('name')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>TOPIK</label>
                            <select class="form-control select-topic @error('topic_id') is-invalid @enderror"
                                name="topic_id">
                                <option value="">-- PILIH TOPIK --</option>
                                @foreach ($topics as $topic)
                                    @if($problem->topic_id == $topic->id)
                                        <option value="{{ $topic->id  }}" selected>{{ $topic->name }} - {{ $topic->category }}</option>
                                    @else
                                        <option value="{{ $topic->id  }}">{{ $topic->name }} - {{ $topic->category }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('topic_id')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>SOLUSI</label>
                            <textarea class="form-control solution @error('solution') is-invalid @enderror" name="solution"
                                placeholder="Masukkan Solusi"
                                rows="10">{!! old('solution', $problem->solution) !!}</textarea>
                            @error('solution')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>TAMBAHAN</label>
                            <input type="text" name="additional" value="{{ old('additional', $problem->additional) }}"
                                placeholder="Masukkan Penjelasan Tambahan"
                                class="form-control @error('additional') is-invalid @enderror">


                            @error('additional')
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.6.2/tinymce.min.js"></script>
    <script>
        var editor_config = {
            selector: "textarea.solution",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
        };

        tinymce.init(editor_config);
    </script>
    </section>
</div>

@stop