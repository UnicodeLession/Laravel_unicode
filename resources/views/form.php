<form action="/any" method="post">
    <input type="text" placeholder="Vui lòng nhập tên" name="name">
    <input type="hidden" name="_method" value="delete">
    <?php echo csrf_field() ?>
    <button type="submit">Gửi</button>
</form>
