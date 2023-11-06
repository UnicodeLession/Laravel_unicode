<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class PostController extends Controller
{
    //
    function index() {
        $posts = Post::all(); // trả về các collections
        $detail = Post::find(1); // meythod ->find($key) sẽ tìm giá trị $key trong field có primary_key của db
        $posts = $posts->reject(function ($post) {
            return $post->status==1; // boolean
            // hiểu rằng nó sẽ từ chối các collection có status là 1 -> ra null và ra 0
        });
//        dd($posts);
        /**
         * Chunk
         *      xử lý dữ liệu lớn -> chunk tiết kiệm memory với việc chia nhỏ các dữ liệu ra
         *      ở dưới "2" có nghĩa là nó sẽ chia tất cả dữ liệu thành từng cặp 2 một
         */
//        Post::chunk(2, function ($posts) {
//            foreach ($posts as $post) {
//                echo $post->title. "<br>";
//            }
//            echo "Kết thúc Chunk "."<br />";
//        });
    }

    function add()
    {
        $dataInsert = [
            'title' =>  rand(0, 1000).'Tiếp cận tín dụng còn hạn chế, tăng trưởng tín dụng thấp',
            'content' => 'Thừa ủy quyền của Thủ tướng Chính phủ, Phó Thủ tướng Chính phủ Trần Lưu Quang sáng 6/11 đã trình bày Báo cáo tóm tắt Tổng hợp việc thực hiện các nghị quyết của Quốc hội về giám sát chuyên đề và chất vấn trong nhiệm kỳ khóa XV và một số nghị quyết trong nhiệm kỳ khóa XIV. ',
            'status' => 1,
        ];

        //! Insert dữ liệu

        // dùng query builder
        $insertStatus = Post::insert($dataInsert); // trả về true và false
        // dùng query khác
        $post = Post::create($dataInsert); // insert data
        $lastInsertId = $post->id;
        /**
         * Phương thức firstOrCreate() chia làm 2 trường hợp
         *      - lấy ra bản ghi đầu tiên của dữ liệu phù hợp với query
         *      - nếu không có data phù hợp với query thì sẽ insert data và trả về bản ghi đó
         */
        $post = Post::firstOrCreate([
            'id'=> 2
        ], $dataInsert);
//        dd($post);
    }
}
