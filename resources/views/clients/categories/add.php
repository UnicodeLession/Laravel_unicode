<h1 style="text-align: center">Thêm chuyên mục</h1>
<div>
    <form action="<?php echo route('categories.add') ?>" method="post">
        <div>
            <input type="text" name="category_name" placeholder="Tên Chuyên Mục...">
            <?php echo csrf_field() ?>
        </div>
        <button type="submit">Thêm Chuyên Mục</button>
    </form>
</div>
