<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException as QE;
use App\Models\Attribute as Attribute;
use Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelFail;

class AttributesController extends AbstractQueryController
{
  private $attr;
  private $pag_count=10;
  public function __construct(Request $request)
  {
    $this->attr = new Attribute;
    $this->middleware('auth:admin');
  }
  public function index()
  {
    return view('admin.pages.attributes')
    ->with([
      // 'attrs'=>$this->attr::all('name','id'),
      'attrs'=>$this->attr::paginate($this->pag_count,['id','name']),
      'count'=>$this->attr::count(),
      'sort'=>'acs']);
  }
  public function store(Request $request)
  {
    $request->validate([
      'name'=> "max:255|unique:attributes|required"
    ]);
    $this->attr->name = $request->name;
    try 
    {
      $this->attr->save();
    }
    catch(QE $qe)
    {
      return redirect()
      ->back()
      ->withErrors(['name'=>'Такий параметр вже існує']);
    }
    session()->flash('msg', 'Параметр додано');
    return redirect()->back();
  }

  public function search(Request $request)
  {
    $request->flash();
    if(empty($request->q))
    {
      $attrs = $this->attr::orderBy('name',$request->sort)
      ->paginate($this->pag_count,['name','id']);
    }
    else 
    {
      $attrs = $this->attr::where('name','LIKE','%'.$request->q.'%')
      ->orderBy('name',$request->sort)
      ->paginate($this->pag_count,['name','id']);
    }
    return view('admin.pages.attributes')
    ->with([
      'attrs'=>$attrs,
      'count'=>$this->attr::count(),
      'sort'=>$request->sort]);
  }

  public function delete(Request $request)
  {
    try
    {
      $this->attr::findOrFail($request->id)->delete();
    }
    catch(ModelFail $e)
    {
      return redirect()->back()->withErrors(['attr_name'=>'Виникла проблема з видаленням параметра. Вірогідно він використовується в продуктах.']);
    }
    session()->flash('msg', 'Параметр видалено з бази');
    return redirect()->back();
  }

  public function update(Request $request)
  {
    $request->validate([
      'name'=> "max:255|unique:attributes|required"
    ]);
    try {
     $this->attr::findOrFail($request->id)
     ->update([
      'name'=>$request->name
    ]);
   } 
   catch (ModelFail $e) {
    return redirect()->back()->withErrors(['update'=>'Такого параметра не існує в базі.']);
  }
  catch (QE $qe){
    return redirect()->back()->withErrors(['update'=>'Не можливо змінити назву параметра.']);
  }
  session()->flash('msg', 'Назву параметра успішно змінено!');
  return redirect()->back();
}
}
