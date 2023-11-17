<h2>Trang chủ dành cho bác sỹ</h2>
<a
    href="{{route('doctors.logout')}}"
    onclick="event.preventDefault(); document.querySelector('#logout-form').submit();"
>{{__('Logout')}}</a>
<form id="logout-form" method="POST" action="{{route('doctors.logout')}}">
    @csrf
</form>
