<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Intervention\Image\Facades\Image;



date_default_timezone_set("Asia/Jakarta");

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index', [
            "title" => "Projects",
            "posts" => Post::orderBy('title', 'asc')->paginate(10)
        ]);
    }

    public function index_projects()
    {
        return view('projects', [
            "title" => "Projects",
            "posts" => Post::orderBy('title', 'asc')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array(
            'title' => "Create post"
        );
        return view('posts.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|unique:posts,title|max:100',
                'description' => 'required',
                'picture' => 'image|nullable|max:10240'
            ],
            [
                'title.required' => 'The title is required.',
                'title.unique' => 'The title has already been taken.',
                'title.max' => 'The title must not be greater than 100 characters.',
                'description.required' => 'The description is required.',
                'picture.max' => 'The picture is too big, please choose another picture'
            ]
        );

        // if ($request->hasFile('picture')) {
        //     $filenameWithExt = $request->file('picture')->getClientOriginalName();
        //     $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //     $extension = $request->file('picture')->getClientOriginalExtension();
        //     $filenameSimpan = $filename . '_' . time() . '.' . $extension;
        //     $path = $request->file('picture')->storeAs('public/posts_image', $filenameSimpan);
        // } else {
        //     $filenameSimpan = 'noimage.png';
        // }
        if ($request->hasFile('picture')) {
            $filenameWithExt = $request->file('picture')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('picture')->getClientOriginalExtension();

            $basename = uniqid() . time();
            // $smallFilename  = "small_{$basename}.{$extension}";
            // $filenameSimpan  = "medium_{$basename}.{$extension}";
            $filenameSimpan  = "large_{$basename}.{$extension}";

            // $filenameSimpan = "{$basename}.{$extension}";
            // $path = $request->file('picture')->storeAs('public/posts_image', $filenameSimpan);

            // $request->file('picture')->storeAs("public/posts_image", $smallFilename);
            $request->file('picture')->storeAs("public/posts_image", $filenameSimpan);
            // $request->file('picture')->storeAs("public/posts_image", $largeFilename);

            // small
            // $smallThumbnailPath = storage_path("app/public/posts_image/{$smallFilename}");
            // $this->createThumbnail($smallThumbnailPath, 150, 93);
            //medium
            // $mediumThumbnailPath = storage_path("app/public/posts_image/{$filenameSimpan}");
            // $this->createThumbnail($mediumThumbnailPath, 300, 185);
            //large
            $largeThumbnailPath = storage_path("app/public/posts_image/{$filenameSimpan}");
            $this->createThumbnail($largeThumbnailPath, 550, 340);
        } else {
            $filenameSimpan = 'noimage.png';
        }

        $paragraph = explode("\r\n", $request->input('description'));
        $description = "";
        for ($i = 0; $i <= count($paragraph) - 1; $i++) {
            $part = str_replace($paragraph[$i], $paragraph[$i] . "<br>", $paragraph[$i]);
            $description .= $part;
        }

        $post = new Post;
        $post->picture = $filenameSimpan;
        $post->title = $request->input('title');
        $post->description = nl2br($request->input('description'));
        // $post->description = $description;
        $post->save();
        return redirect('posts')->with('success', 'Berhasil Menambah Project Baru!!');
    }

    public function createThumbnail($path, $width, $height)
    {
        $img = Image::make($path)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($path);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('posts.show', [
            'title' => "Detail Project",
            'posts' => Post::find($id)
        ]);

        // $data = array(
        //     'id' => "posts",
        //     'title' => "Detail Author",
        //     'posts' => Post::find($id)
        // );
        // return view('posts.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('posts.edit', [
            'title' => "Edit Project",
            'posts' => Post::find($id)
        ]);
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
        $request->validate([
            'title' => 'required|max:100',
            'description' => 'required',
            'picture' => 'image|nullable|max:10240'
        ]);
        // Cara 1 tidak worth it pas update file gambar
        // if ($request->hasFile('picture')) {
        //     $filenameWithExt = $request->file('picture')->getClientOriginalName();
        //     $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //     $extension = $request->file('picture')->getClientOriginalExtension();
        //     $filenameSimpan = $filename . '_' . time() . '.' . $extension;
        //     $path = $request->file('picture')->storeAs('public/posts_image', $filenameSimpan);
        //     $post = Post::find($id);
        //     File::delete(public_path() . '/public/posts_image/' . $post->picture);
        // } else {
        //     $filenameSimpan = 'noimage.png';
        // }
        // Post::where('id', $id)->update([
        //     'picture' => $filenameSimpan,
        //     'title' => $request->title,
        //     'description' => $request->description
        // ]);
        // return redirect('posts')->with('success', 'Berhasil diupdate!!');
        // cara lainnya
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->description = nl2br($request->input('description'));
        if ($request->hasFile('picture')) {
            if ($post->picture) {
                unlink('storage/posts_image/' . $post->picture);
            }
            $filenameWithExt = $request->file('picture')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('picture')->getClientOriginalExtension();
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('picture')->storeAs('public/posts_image', $filenameSimpan);
        } else {
            $filenameSimpan = 'noimage.png';
        }
        $post->picture = $filenameSimpan;
        $post->update();
        return redirect('posts')->with('success', 'Berhasil diupdate!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post->picture) {
            unlink('storage/posts_image/' . $post->picture);
        }
        $post->delete();
        return redirect('posts')->with('success', 'Berhasil dihapus!!');
    }

    public function __construct()
    {
        $this->middleware('auth', ["except" => ["index", "show"]]);
    }
}
