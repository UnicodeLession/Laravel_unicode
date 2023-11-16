<h1> Học về Authentication Laravel</h1>
{{--Nếu không có ->middleware('auth') thì để check đăng nhập có thể dùng dưới --}}
@if (\Illuminate\Support\Facades\Auth::check())
    <h3>Đã Đăng Nhập</h3>
    <ul>
        <li>ID: {{$userDetails->id}}</li>
        <li>Email: {{$userDetails->email}}</li>
        <li>Name: {{$userDetails->name}}</li>
    </ul>
@else
    <h3>Chưa Đăng Nhập</h3>
@endif
