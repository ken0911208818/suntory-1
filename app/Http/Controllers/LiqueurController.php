<?php

namespace App\Http\Controllers;

use App\Liqueur;
use App\LiqueurImg;
use Dotenv\Regex\Success;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LiqueurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Liqueur::with('imgs')->get();
        return View('auth.liqueur.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('auth.liqueur.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();
        //酒類名稱建立
        $liqueur = Liqueur::create($data);

        //圖片建立ID
        $imgs = $data['img'];
        foreach ($imgs as $img) {
            $image = new LiqueurImg();
            $image->liqueur_id = $liqueur->id;
            $image->img = $img;
            $image->save();
        }
        $new = Liqueur::with('imgs')->find($liqueur->id);
        return $new;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Liqueur::with('imgs')->find($id);
        return $data;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $new = $request->all();

        $imgs = $new['img'];
        foreach ($imgs as $img) {
            $table = LiqueurImg::where('img', $img)->first();
            if ($table == null) {
                $newimgs = new LiqueurImg();
                $newimgs->liqueur_id = $id;
                $newimgs->img = $img;
                $newimgs->save();
            }        }
        $data = Liqueur::with('imgs')->find($id);
        $data->update($new);

        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $imgs = LiqueurImg::where('liqueur_id', $id)->get();
        foreach ($imgs as $img) {
            $img->delete();
        }
        $data = Liqueur::find($id);
        $data->delete();

        return 'successful';
    }

    public function liqueur_upload_img()
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
            if (!is_dir('upload/img')) {
                mkdir('upload/img');
            }
            $destination = public_path() . '/upload/img/' . $filename; //change this directory
            $location = $_FILES["file"]["tmp_name"];
            move_uploaded_file($location, $destination);
            $img = "/upload/img/" . $filename;
            $liqueur_img = new LiqueurImg();

            $liqueur_img->img = $img;
            $liqueur_img->save();
            $id = $liqueur_img->id;
            $new_ary = [
                'id' => $liqueur_img->id,
                'img' => $img,
            ];
            return $new_ary; //change this URL

        }
        exit;
    }
    public function liqueur_delete_img(Request $request)
    {
        $data = $request->all();
        $old_image = $data['file_link'];
        $id = $data['id'];
        if (file_exists(public_path() . $old_image)) {
            File::delete(public_path() . $old_image);
        }
        $delete = LiqueurImg::find($id);
        $delete->delete();
        return "successsful";

    }
}
