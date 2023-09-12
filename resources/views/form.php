<form action="/" method="post">
    <input type="text" placeholder="Vui lòng nhập tên" name="name">
    <input type="hidden" name="method" value="post">
    <?php echo csrf_field() ?>
    <button type="submit">Gửi</button>
</form>
