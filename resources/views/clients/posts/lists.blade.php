@extends('layouts.client')
@section('title')
    {{ $title }}
@endsection

@section('content')
    @if(session('msg'))
        <div class="alert alert-{{session('type')}} text-center">
            {{ session('msg') }}
        </div>
    @endif
    <h1>{{ $title }}</h1>
    <form action="{{route('posts.delete-any')}}" method="post" onsubmit="return confirm('Bài viết được chọn sẽ bị chuyển vào thùng rác, bạn chắc chắn muốn xóa tạm thời?')">
        @csrf
        <button type="submit" class="btn btn-sm btn-warning">Xóa Tạm Thời</button>
        <hr>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th width="5%">
                    <input type="checkbox" name="" id="checkAll">
                </th>
                <th width="5%">STT</th>
                <th>Tiêu Đề</th>
                <th width="15%">Trạng Thái</th>
                <th width="11%">Hành Động</th>
            </tr>
            </thead>
            <tbody>
            @if($allPosts->count() > 0)
                @foreach($allPosts as $key=>$post)
                    <tr>
                        <td>
                            <input type="checkbox" name="delete[]" value="{{$post->id}}">
                        </td>
                        <td>{{$key +1}}</td>
                        <td>{{$post->title}}</td>
                        <td>
                            @if($post->trashed())
                                <button class="btn btn-danger btn-sm">Đã Xóa</button>
                            @else
                                <button class="btn btn-success btn-sm">Chưa Xóa</button>
                            @endif
                        </td>
                        <td style="display: flex; flex-direction: column;">
                            @if($post->trashed())
                                <a style="margin-bottom: 5px" href="{{route('posts.restore', $post)}}" class="btn btn-sm btn-primary"><i class="fa-solid fa-arrow-rotate-left"></i></a>
                                <a  href="{{route('posts.force-delete', $post)}}" class="force-delete-post btn btn-sm btn-danger" data-confirm="Bạn có chắc chắn muốn xóa vĩnh viễn bài viết?"><i class="fa-solid fa-trash"></i></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </form>
@endsection
@section('js')
    <script>
        document.querySelectorAll('.force-delete-post').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const confirmation = this.getAttribute('data-confirm');
                if (!confirm(confirmation)) {
                    e.preventDefault();
                }
            });
        });
    </script>
@endsection
