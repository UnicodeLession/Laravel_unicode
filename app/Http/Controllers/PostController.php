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
        $title = 'Danh sách các bài viết';
        $allPosts = Post::withTrashed()
            ->orderBy('deleted_at', 'ASC')
            ->orderBy('id', 'DESC')
            ->get();
        return view('clients.posts.lists', compact('title','allPosts' ));
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

    function update($id)
    {
        // tạo đối tượng bản ghi hiện tại
        $post = Post::find($id);
        // Cách 1:
//        $post->title = 'Bài Viết '.$id.' sau khi update';
//        $post->content= 'Nội dung bài viết '.$id.' sau khi update';
//        $post->status = 1;
//        $post->save();
        // Cách 2:
        $dataUpdate = [
            'title' => 'Bài Viết '.$id.' sau khi update',
            'content' => 'Nội dung bài viết '.$id.' sau khi update',
            'status' => 1
        ];
//        $status = $post->update($dataUpdate);
//        $status = Post::where('id', '=', $id)->update($dataUpdate);
        // Cách 3: Nếu Tìm thấy phù hợp query thì update không thì Create
        Post::updateOrCreate([
            'id' => $id
        ],$dataUpdate);
    }
    function delete($id){
//        $status = Post::destroy($id); // xóa hoàn toàn khỏi DB
        $idCollect = collect([15, 16, 17]);
        dd($idCollect);
    }
    function handleDeleteAny(Request $request){
        $deleteArr = $request->delete; // lấy ra các id muốn xóa
        if(!empty($deleteArr)){
            // xử lý xóa do có dữ liệu
            $status = Post::destroy($deleteArr);
            if ($status) {
                $msg = 'Xóa '.count($deleteArr).' bài viết thành công!';
                $type = 'success';
            }else{
                $msg = "Bạn Không Không Thể Xóa Lúc Này! Vui Lòng Thử Lại Sau!";
                $type = 'danger';
            }
        } else {
            $msg = "Vui Lòng Chọn Bài Viết Bạn Muốn Xóa!";
            $type = 'danger';
        }
        return redirect()
            ->route('posts.index')
            ->with('msg', $msg)
            ->with('type', $type);
    }
    function restore($id){
        $post = Post::onlyTrashed()->where('id', '=', $id)->first();
        if (!empty($post)){
            $post->restore();
            return redirect()->route('posts.index')
                ->with('msg', 'Khôi phục bài viết thành công!')
                ->with('type', 'success');
        }
        return redirect()->route('posts.index')
            ->with('msg', 'Bài viết không tồn tại!')
            ->with('type', 'danger');
    }
    function forceDelete($id){
        $post = Post::onlyTrashed()->where('id', '=', $id)->first();
        if (!empty($post)){
            $post->forceDelete();
            return redirect()->route('posts.index')
                ->with('msg', 'Xóa vĩnh viễn bài viết thành công!')
                ->with('type', 'success');
        }
        return redirect()->route('posts.index')
            ->with('msg', 'Bài viết không tồn tại!')
            ->with('type', 'danger');
    }
}
