<?php

namespace App\Http\Controllers;

use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ShopController extends Controller
{
    public function index()
    {
        $data = Shop::all();
        return view('auth/shop/index', compact('data'));
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $ready = Shop::create($data);
        return $ready;
    }
    public function edit($id)
    {
        $data = Shop::find($id);
        return $data;
    }
    public function update(Request $request, $id)
    {
        $new = $request->all();
        $data = Shop::find($id);
        $data->update($new);

        return $data;
    }
    public function destroy($id)
    {
        Shop::find($id)->delete();
        return 'success';
    }

    public function shop_upload_img()
    {
        // A list of permitted file extensions
        $allowed = array('png', 'jpg', 'gif', 'zip');
        if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
            $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            if (!in_array(strtolower($extension), $allowed)) {
                echo '{"status":"error"}';
                exit;
            }
            $name = strval(time() . md5(rand(100, 200)));
            $ext = explode('.', $_FILES['file']['name']);
            $filename = $name . '.' . $ext[1];
            //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
            if (!is_dir('upload/')) {
                mkdir('upload/');
            }
            //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
            if (!is_dir('upload/Methodimg')) {
                mkdir('upload/Methodimg');
            }
            $destination = public_path() . '/upload/Methodimg/' . $filename; //change this directory
            $location = $_FILES["file"]["tmp_name"];
            move_uploaded_file($location, $destination);
            echo "/upload/Methodimg/" . $filename; //change this URL
        }
        exit;
    }

    public function shop_delete_img(Request $request)
    {
        if (file_exists(public_path() . $request->file_link)) {
            File::delete(public_path() . $request->file_link);
        }
        return $request;
    }

    public function Shop_text()
    {
        $data = Shop::all();
        return $data;
    }
}
