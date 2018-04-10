<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libs\WithImg;
use Illuminate\Database\QueryException as QE;
use Auth;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Models\Blog;

class BlogController extends Controller
{
    /**
     * count items on page
     * @var Int
     */
    private $page_count = 10;

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $b = new Blog();
        return view('admin.pages.blogs')->with([
            'blogs' => $b->getBlogs2AdminIndex()->paginate($this->page_count),
            'count'=>$b::count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.blog_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'img_upload' => 'mimes:jpeg,png,jpg|max:5120',
            'title' => 'max:100|required|unique:blogs',
            'body' => 'required',
        ]);
        $user = Auth::user()->name;
        $photo = config('app.img_default');
        if ($request->hasFile('img_upload')) {
            $img = new WithImg();
            $photo = $img->getImageFileName($request->file('img_upload'), $request->title, False, 825);
        }
        try {
            $id = $this->storeBlogData($request, $photo);
            if (!$id) {
                throw new Exception('Дані блога не записано');
            }
        } catch (Exception $e) {
            Log::error('Blog create', ['msg' => $e->getMessage(), 'user' => $user]);
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
        Log::info('Blog create', ['user' => $user, 'blog_id' => $id]);
        return redirect(route('blog.index'))->with('msg', 'Запис статті зроблено');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect(route('blog.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.pages.blog_edit')->with([
            'id' => $id,
            'blog' => Blog::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'img_upload' => 'mimes:jpeg,png,jpg|max:5120',
            'title' => 'max:100|required|',
            'body' => 'required',
            'url_slug' => 'required|max:255',
        ]);
        $user = Auth::user()->name;
        $blog = new Blog();
        $img = new WithImg();
        $photo = $blog::find($id)->photo;
        if ($request->hasFile('img_upload')) {
            try {
                $img->delete_photo($photo);
            } catch (Exception $e) {
                Log::error('Update blog', ['msg' => 'deleting file' . $e->getMessage(), 'user' => $user, 'blog id' => $id]);
                return redirect()->back()->withErrors(['msg' => $e->getMessage()]);
            };
            $photo = $img->getImageFileName($request->file('img_upload'), $request->title, False, 825);
        }
        try {
            $blog::findOrFail($id)->update([
                'title' => $request->title,
                'body' => $request->body,
                'photo' => $photo,
                'published' => $request->published,
                'url_slug' => 'b-' . url_slug($request->title),
            ]);
        } catch (QE $qe) {
            Log::error('Blog update', ['msg' => $qe->getMessage(), 'user' => $user, 'blog id' => $id]);
            return redirect()->back()->withErrors(['Error' => 'Сталась помилка оновлення даних']);
        }
        Log::info('Blog update', ['user' => $user, 'blog id' => $id]);
        return redirect(route('blog.index'))->with('msg', 'Зміни записано');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user()->name;
        try{
            $blog = Blog::find($id);
            $photo = $blog->photo;
            $blog->delete();
            $img = new WithImg();
            $img->delete_photo($photo);
        }catch (QE $qe){
            Log::error('Blog delete',['msg'=>$qe->getMessage(),'user'=>$user,'blog id'=>$id]);
            return redirect()->back()->withErrors(['msg'=>'Виникла помилка з видаленням запису блогу']);
        }
        Log::info('Blog delete',['user'=>$user,'blog id'=>$id]);
        return redirect(route('blog.index'))->with('msg','Стаття видалена');
    }

    /**
     * MassStoring blog data 2 DB
     * @param Request $request
     * @param $photo
     * @return Integer|Null blog ID
     */
    private function storeBlogData(Request $request, $photo)
    {
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->body = $request->body;
        $blog->photo = $photo;
        $blog->url_slug = 'b-' . url_slug($request->title);
        $blog->published = $request->published;
        $blog->views = 0;
        $blog->save();
        return $blog->id;
    }

    public function search(Request $request)
    {
        $q = $request->q;
        $blog = new Blog;
        $blogs = $blog->search($q)->paginate($this->page_count)->appends(['q'=>$q]);
        return view('admin.pages.blogs')->with(['blogs'=>$blogs,'q'=>$q]);
    }
    /**
     * Add 2 views count one point
     * @param Integer $id blog ID
     */
    public function addView($id){
        $blog = Blog::find($id);
        $views = $blog->views;
        $blog->views=$views+1;
        $blog->save();
    }
}
