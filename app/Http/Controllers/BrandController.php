<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException as QE;
use App\Models\Brand as Brand;
use Auth;

//use Illuminate\Database\Eloquent\ModelNotFoundException as ModelFail;

class BrandController extends AbstractQueryController
{

    private $pag_count = 10;

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin.pages.brands')
            ->with([
                'brands' => Brand::paginate($this->pag_count),
                'count' => Brand::count(),
                'sort' => 'acs']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => "max:255|unique:brands|required"
        ]);
        $name = $request->name;
        try {
            Brand::insert(['name' => $name]);
        } catch (QE $qe) {
            //TODO: remove debug info $qe
            return redirect()
                ->back()
                ->withErrors(['brand_name' => 'Такий виробник вже існує' . $qe->getMessage()]);
        }
        session()->flash('msg', 'Виробника додано');
        return redirect()->back();
    }

    public function search(Request $request)
    {
        $request->flash();
        if (empty($request->q)) {
            $brands = Brand::orderBy('name', $request->sort)
                ->paginate($this->pag_count);
        } else {
            $brands = Brand::where('name', 'LIKE', '%' . $request->q . '%')
                ->orderBy('name', $request->sort)
                ->paginate($this->pag_count);
        }
        return view('admin.pages.brands')
            ->with([
                'brands' => $brands,
                'count' => Brand::count(),
                'sort' => $request->sort]);
    }

//  public function delete(Request $request)
    public function delete($id)
    {
        try {
            Brand::findOrFail($id)->delete();
        } catch (QE $qe) {
            //TODO: remove debug info $qe
            return redirect()->back()->withErrors(['name' => 'Виникла проблема з видаленням назви виробника. Вірогідно він використовується в продуктах.' . $qe->getMessage()]);
        }
        session()->flash('msg', 'Виробника видалено з бази');
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => "max:255|unique:brands|required"
        ]);
        try {
            Brand::findOrFail($request->id)
                ->update([
                    'name' => $request->name,
                ]);
        } catch (QE $qe) {
            $request->flash();
            //TODO: remove debug info $qe
            return redirect()->back()->withErrors(['update' => 'Не можливо змінити назву виробника.' . $qe->getMessage()]);
        }
        session()->flash('msg', 'Назву виробника успішно змінено!');
        return redirect()->back();
    }

}
