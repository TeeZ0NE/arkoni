<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Tag;
use App\Models\RuTag;
use App\Models\UkTag;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException as QE;

class TagController extends Controller
{
    /**
     * Count of page on paginate
     * @var int
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
        $tag = new Tag();
        return view('admin.pages.tags')->with([
            'count' => Tag::count(),
            'tags' => $tag->searchAndSort()->paginate($this->page_count),
            'sort' => 'asc',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.tags_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'ru_name' => "max:200|unique:ru_tags|required",
            'uk_name' => "max:255|unique:uk_tags|required",
            "ru_title" => "max:70|required",
            "uk_title" => "max:70|required",
            "uk_description" => "required|max:255",
            "ru_description" => "required|max:255"
        ]);
        $user = Auth::user()->name;
        try {
            $tag_id = $this->storeNewTag($request->ru_name);
            if (!$tag_id) {
                throw new Exception("Новий тeг не створено");
            }
            $res = $this->storeLangTag($request, $tag_id);
            if (!$res) {
                throw new Exception('Язикові файли не було записано');
            }
        } catch (QE $qe) {
            //TODO: remove debug info $qe
            Log::error("Can't store tags", ['mes' => $qe->getMessage(), 'user' => $user]);
            return redirect()
                ->back()
                ->withErrors(['name' => $qe->getMessage()]);
        }
        Log::info('Attributes add', ['user' => $user]);
        return redirect(route('tags.index'))->with('msg', 'Параметр додано');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.pages.tags_edit')->with([
            'tags' => Tag::with(['getUkTag', 'getRuTag'])->findOrFail($id),
            'id' => $id,
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
        request()->validate([
            'ru_name'=>'required|max:250',
            'uk_name'=>'required|max:255',
            'ru_title'=>'required|max:70',
            'uk_title'=>'required|max:70',
            'uk_description'=>'required|max:255',
            'ru_description'=>'required|max:255',
            'tag_url_slug'=>'required|max:250'
        ]);
        try {
            $user = Auth::user()->name;
            Tag::findOrFail($id)->update([
                'tag_url_slug' => 't-' . $request->tag_url_slug
            ]);
            $res = $this->storeLangTag($request, $id);
            if (!$res) {
                throw new Exception("Язикові файли не було записано");
            }
        }
    catch(Exception $e){
            Log::error('Tag update',['msg'=>$e->getMessage(),'user'=>$user]);
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
        Log::info('Tag update',['user'=>$user]);
        return redirect(route('tags.index'))->with('msg','Зміни тега записано');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = Auth::user()->name;
            $tag = new Tag();
            $tag::findOrFail($id)->delete();
        } catch (QE $qe) {
            Log::error('Tag delete', ['msg' => $qe->getMessage(), 'user' => $user]);
            //TODO::delete $qe debug
            return redirect()->back()->withErrors(['msg' => 'Виникла помилка з видаленням тега' . $qe->getMessage()]);
        }
        Log::info('Tag delete', ['user' => $user]);
        return redirect(route('tags.index'))->with('msg', 'Тег видалено з бази');
    }

    /**
     * storing new tag and writing own URL
     * @param String $ru_name
     * @return int or null
     */
    private function storeNewTag($ru_name)
    {
        $tag = new Tag();
        $tag->tag_url_slug = 't-' . url_slug($ru_name);
        $tag->save();
        return $tag->id;
    }

    /**
     * storing lang in tebles
     * @param Request $request
     * @param Int $id tag ID
     * @return Boolean if stored
     */
    private function storeLangTag(Request $request, $id)
    {
        $ru_tag = new RuTag();
        $uk_tag = new UkTag();
        $ru = $ru_tag::updateOrCreate(['tag_id' => $id], [
            'ru_name' => $request->ru_name,
            'title' => $request->ru_title,
            'description' => $request->ru_description,
        ]);
        $uk = $uk_tag::updateOrCreate(['tag_id' => $id], [
            'uk_name' => $request->uk_name,
            'title' => $request->uk_title,
            'description' => $request->uk_description,
        ]);
        return ($ru AND $uk) ? 1 : 0;
    }

    public function search(Request $request){
        $request->flash();
        $sort = $request->sort;
        $q = $request->q;
        $tags = new Tag();
        return view('admin.pages.tags')->with([
            'count'=>$tags::count(),
            'sort' =>$sort,
            'tags'=>$tags->searchAndSort($q, $sort)->paginate($this->page_count),
        ]);
    }
}
