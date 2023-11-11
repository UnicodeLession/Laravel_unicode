<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model
{
    use HasFactory;
    use SoftDeletes;
    // xóa mềm : thêm thời gian vào field deleted_at và sẽ lọc tất cả dữ liệu với deleted_at = null
    /**
     *Cấu hình tên table
     * Mặc định khi tạo Model trong Laravel, tên table sẽ được quy ước mặc định theo cú pháp sau:
     * - Chữ thường
     * - Mỗi chữ cách nhau bởi dấu gạch dưới _
     * - Dạng số nhiều
     * Ví dụ: Tạo Model có tên Post thì tên table sẽ là posts
     *        Tên Model: ProductCategory thì tên table sẽ là product_categories
     */
     // nếu muốn cấu hình table riêng thì dùng
    protected $table = 'posts';
    // cấu hình khóa chính | bình thường field 'id' sẽ nhận làm khóa chính
//    protected $primaryKey = 'id';
    // trong trường hợp khóa chính không ở chế độ Auto_Increment và không phải kiểu số
//    public $incrementing = false;
    // thay đổi data_type của khóa chính
//    protected $keyType = 'string';
    /**
     *Cấu hình Timestamp
     * Mặc định, Laravel sẽ ngầm hiểu table có sẵn 2 trường created_at và updated_at
     * bỏ ràng buộc create_at và update_at
     * nếu để true thì sẽ cập nhật cả created_at và updated_at
     * nếu để false thì sẽ để cả 2 giá trị trên là null
     */
    public $timestamps = true;
    // nếu khi push data lên database nếu k có giá trị của status thì nó sẽ kèm theo giá trị bên dưới
    protected $attributes = [
        'status' => 0,
    ];
    //bắt buộc phải có $fillable để ràng buộc các giá trị thêm vào
    protected $fillable = ['title', 'content', 'status'];

}
