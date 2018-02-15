<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException as QE;
use App\Models\Brand as Brand;
use Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelFail;
class BrandsController extends AbstractQueryController
{
  private $brand;
  private $pag_count=10;
  public function __construct(Request $request)
  {
    $this->brand = new Brand;
    $this->middleware('auth:admin');
  }
  public function index()
  {
    return view('admin.pages.brands')
    ->with([
      // 'brands'=>$this->brand::all('name','id'),
      'brands'=>$this->brand::paginate($this->pag_count,['id','name']),
      'count'=>$this->brand::count(),
      'sort'=>'acs']);
  }
  public function store(Request $request)
  {
    $request->validate([
      'name'=> "max:255|unique:brands|required"
    ]);
    $this->brand->name = $request->name;
    $this->brand->url_slug = url_slug($request->name);
    try 
    {
      $this->brand->save();
    }
    catch(QE $qe)
    {
      return redirect()
      ->back()
      ->withErrors(['brand_name'=>'Такий виробник вже існує'.$qe]);
    }
    session()->flash('msg', 'Виробника додано');
    return redirect()->back();
  }

  public function search(Request $request)
  {
    $request->flash();
    if(empty($request->q))
    {
      $brands = $this->brand::orderBy('name',$request->sort)
      ->paginate($this->pag_count,['name','id']);
    }
    else 
    {
      $brands = $this->brand::where('name','LIKE','%'.$request->q.'%')
      ->orderBy('name',$request->sort)
      ->paginate($this->pag_count,['name','id']);
    }
    return view('admin.pages.brands')
    ->with([
      'brands'=>$brands,
      'count'=>$this->brand::count(),
      'sort'=>$request->sort]);
  }

  public function delete(Request $request)
  {
    try
    {
      $this->brand::findOrFail($request->id)->delete();
    }
    catch(ModelFail $e)
    {
      return redirect()->back()->withErrors(['name'=>'Виникла проблема з видаленням назви виробника. Вірогідно він використовується в продуктах.']);
    }
    session()->flash('msg', 'Виробника видалено з бази');
    return redirect()->back();
  }

  public function update(Request $request)
  {
    $request->validate([
      'name'=> "max:255|unique:brands|required"
    ]);
    try {
     $this->brand::findOrFail($request->id)
     ->update([
      'name'=>$request->name,
      'url_slug'=>url_slug($request->name)
    ]);
   } 
   catch (ModelFail $e) {
    return redirect()->back()->withErrors(['update'=>'Такого виробника не існує в базі.']);
  }
  catch (QE $qe){
    return redirect()->back()->withErrors(['update'=>'Не можливо змінити назву виробника.']);
  }
  session()->flash('msg', 'Назву виробника успішно змінено!');
  return redirect()->back();
}
}
