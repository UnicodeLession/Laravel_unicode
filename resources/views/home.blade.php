<body>
<h2>Khai báo biến</h2>
@php
$id = 1;
$users = [
    'person_1'=> 'Nguyễn Minh Hiếu 1',
    'person_2'=>'Nguyễn Minh Hiếu 2'
];
$books = [];

@endphp
<h2>If statement</h2>
@if($id <= 1)
    {{ $id }} : nhỏ hơn bằng 1
@elseif($id > 1 && $id<10)
    {{ $id }} : từ khoảng (1, 10)
@else
    {{ $id }} : lớn hơn 10
@endif
<h2>Switch Case</h2>
@switch($id)
    @case($id <= 1)
        First Case : id = {{ $id }} : id nhỏ hơn bằng 1
        @break
    @case($id > 1 && $id<10)
        Second Case : id = {{ $id }} : id từ khoảng (1,10)
        @break
    @case($id>=10)
        Third Case : id = {{ $id }} : id lớn hơn 10
        @break
@endswitch


<h2>Loops</h2>

<h3>For</h3>
<ul>
    @for($i = 1; $i<=3; $i++)
        <li>Phần tử {{ $i }}</li>
    @endfor
</ul>

<h3>Foreach</h3>
<ul>
    @foreach($users as $key => $user)
        <li>This is user : {{ $key }} = {{ $user }}</li>
    @endforeach
</ul>

<h3>Forelse</h3>
@forelse($books as $book )
    <li>{{ $book }}</li>
@empty
    <h4>forelse là đặc biệt của blade template</h4>
    <ul>
        <li><strong>Nếu Array có dữ liệu: </strong> thì sẽ thực hiện phòng lặp như <code>foreach</code></li>
        <li><strong>Nếu Array không có dữ liệu: </strong> thì sẽ thực hiện dòng code của <code>empty</code></li>
    </ul>
    <p>Xin lỗi hiện nay chưa có sách</p>
@endforelse

<h3>While loop</h3>
@while($id <=3)
    <li>Đây là vòng lặp while với id = {{ $id }}</li>
    @php
    $id ++
    @endphp
@endwhile

<h3>Continue and Break</h3>
@php
    $users = [
        ['name' => 'John', 'type' => 1, 'number' => 3],
        ['name' => 'Alice', 'type' => 2, 'number' => 5],
        ['name' => 'Alice_2', 'type' => 2, 'number' => 5],
        ['name' => 'Bob', 'type' => 1, 'number' => 2],
        ['name' => 'Eve', 'type' => 3, 'number' => 1],
        ['name' => 'Charlie', 'type' => 1, 'number' => 5],
    ];
@endphp
@foreach ($users as $user)
    @continue($user['type'] == 1)

{{--    Nếu $user['type'] == 1 thì sẽ bỏ qua
        Type khác 1 thì sẽ tiếp tục
--}}

    <li>{{ $user['name'] }}</li>
{{-- Khi type khác 1 thì sẽ tiếp tục cái dưới với number = 5 thì sẽ trực tiếp break loop--}}
    @break ($user['number'] == 5)
@endforeach

<h3>The Loop Variable</h3>
<span>Trong Foreach tồn tại biến <code>$loop</code> </span>
@php
    $items = [
        ['name' => 'Product 1', 'price' => 100],
        ['name' => 'Product 2', 'price' => 50],
        ['name' => 'Product 3', 'price' => 75],
        ['name' => 'Product 4', 'price' => 120],
    ];
@endphp

<h4>Product List</h4>

<ul>
    @foreach ($items as $item)
        <li>
            <strong>{{ $item['name'] }}</strong><br>
            Price: ${{ $item['price'] }}<br>

            @if ($loop->first)
                <span class="label">First item</span>
            @endif

            @if ($loop->last)
                <span class="label">Last item</span>
            @endif
        </li>
    @endforeach
</ul>

</body>
