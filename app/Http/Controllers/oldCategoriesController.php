<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException as QE;
use App\Models\Category as Cat;
use App\Models\RuCategory as RuCat;
use App\Models\UkCategory as UkCat;
use Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelFail;

class CategoriesController extends AbstractQueryController
{
  /**
   * count of page on pagination
   * @var integer
   */
  private $page_count=10;

  public function __construct()
  {
    $this->middleware('auth:admin');
  }
  public function index()
  {
      return "index cat";
    return view('admin.pages.categories')->with([
      // 'cats_all' => $this->cat::with('sub_cat')->orderBy('name')->get(),
        'cats'=>RuCat::with('getCategory')->paginate($this->page_count,['cat_id','name']),
     // 'parent_cats' => $this->pcat::orderBy('name')->get(),
     // 'cats'     => $this->cat::with('parent_cat')->paginate($this->pag_count,['name','id','parent_id']),
      'count'    => Cat::count(),
      'sort'     => 'acs']);
  }
  public function store(Request $request)
  {
    $request->validate([
      'name'=> "max:255|unique:categories|required",
      'parent_id' => "required"
    ]);
    $this->cat->name      = $request->name;
    $this->cat->url_slug  = url_slug($request->name);
    $this->cat->parent_id = $request->parent_id;
    try 
    {
      $this->cat->save();
    }
    catch(QE $qe)
    {
      return redirect()
      ->back()
      ->withErrors(['cat_name'=>'Така категорія вже існує'.$qe]);
    }
    session()->flash('msg', 'Категорію додано');
    return redirect()->back();
  }

  public function search(Request $request)
  {
    $request->flash();
    if(empty($request->q))
    {
// 'cats'     => $this->cat::with('parent_cat')->paginate($this->pag_count,['name','id','parent_id']),
      
      $cats = $this->cat::orderBy('name',$request->sort)
      ->paginate($this->pag_count,['name','id','parent_id']);
    }
    else 
    {
      $cats = $this->cat::where('name','LIKE','%'.$request->q.'%')
      ->orderBy('name',$request->sort)
      ->paginate($this->pag_count,['name','id','parent_id']);
    }
    return view('admin.pages.categories')
    ->with([
     // 'cats_all' => $this->cat::with('sub_cat')->orderBy('name')->get(),
     'cats'     => $cats,
     'count'    => $this->cat::count(),
     'parent_cats' => $this->pcat::orderBy('name')->get(),
     'sort'     => $request->sort]);
  }

  public function delete(Request $request)
  {
    try
    {
      $this->cat::findOrFail($request->id)->delete();
      $count= $this->cat::where('parent_id',$request->id)->update(['parent_id'=>null]);
    }
    catch(ModelFail $e)
    {
      return redirect()->back()->withErrors(['name'=>'Виникла проблема з видаленням категорії. Вірогідно вона використовується в продуктах.']);
    }
    session()->flash('msg','Категорію видалено з бази. Задіяно '.$count.' підкатегорій.');
    return redirect()->back();
  }

  public function update(Request $request)
  {
    $request->validate([
      'name'=> "max:255|required",
      'parent_id' => "required"
    ]);
    try {
      $name = $request->name;
      // $parent_id = ($request->parent_id)?$request->parent_id:NULL;
      $this->cat::findOrFail($request->id)
     ->update([
      'name'     => $name,
      'url_slug' => url_slug($name),
      'parent_id'=>$request->parent_id
    ]);
   } 
   catch (ModelFail $e) {
    return redirect()->back()->withErrors(['update'=>'Такої категорії не існує в базі.']);
  }
  catch (QE $qe){
    return redirect()->back()->withErrors(['update'=>'Не можливо змінити назву категорії.']);
  }
  session()->flash('msg', 'Назву категорії успішно змінено!');
  return redirect()->back();
}
}
