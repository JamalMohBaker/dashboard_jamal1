@extends('layouts.dashboard')
@section('content')
@if (session()->has('success'))
<div id="success-message" class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<div class="row gap-0 ">
    @foreach($news as $post)
        <div class="col-lg-4 col-md-6 col-12 mt-1 mb-3 position-relative">
            <div class=" border border-info p-3" style="height: 150px; overflow: scroll;" data-aos="fade-up">
                {!! $post->news !!}
                {{-- {{ strip_tags($post->news) }} --}}
                {{-- {{ str_replace('&nbsp;', ' ', strip_tags($post->news)) }} --}}

            </div>
            @if (in_array(Auth::user()->type, ['admin', 'user_management']))
            <form id="deleteform{{ $post->id }}" action="{{ route('news.destroy', $post->id) }}"
                method="post" style="display: none">
                @csrf
                @method('delete')
                {{-- <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button> --}}
            </form>
            <a href="{{ route('tiles.destroy', $post->id) }} "
                onclick="event.preventDefault(); document.getElementById('deleteform{{ $post->id }}').submit();"
                class="btn btn-icon btn-sm btn-danger-transparent rounded-pill ms-1 position-absolute" style="bottom: 10;right:30px;"><i
                    class="ri-delete-bin-line"></i>
            </a>
            @endif
        </div>
    @endforeach
</div>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
@endsection


</body>

