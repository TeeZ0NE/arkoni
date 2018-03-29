<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException as QE;
use App\Models\Brand as Brand;
use Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

//use Illuminate\Database\Eloquent\ModelNotFoundException as ModelFail;

class BrandController extends Controller
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
        $user = Auth::user()->name;
        try {
            Brand::insert(['name' => $name]);
        } catch (QE $qe) {
            //TODO: remove debug info $qe
            Log::error("Can't store brand", ['msg' => $qe->getMessage(), 'user' => $user]);
            return redirect()
                ->back()
                ->withErrors(['brand_name' => 'Такий виробник вже існує' . $qe->getMessage()]);
        }
        Log::info('Brand add', ['user' => $user]);
        return redirect(route('brands'))->with('msg', 'Виробника додано');
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
        $user = Auth::user()->name;
        try {
            Brand::findOrFail($id)->delete();
        } catch (QE $qe) {
            //TODO: remove debug info $qe
            Log::error('Brand delete error', ['msg' => $qe, 'user' => $user, 'brand id'=>$id]);
            return redirect()->back()->withErrors(['name' => 'Виникла проблема з видаленням назви виробника. Вірогідно він використовується в продуктах.' . $qe->getMessage()]);
        }
        Log::info('Brand delete', ['user' => $user, 'brand id'=>$id]);
        return redirect(route('brands'))->with('msg', 'Виробника видалено з бази');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => "max:255|unique:brands|required"
        ]);
        $user = Auth::user()->name;
        try {
            Brand::findOrFail($request->brand_id)
                ->update([
                    'name' => $request->name,
                ]);
        } catch (QE $qe) {
            Log::error('Brand update', ['msg' => $qe->getMessage(), 'user' => $user]);
            $request->flash();
            //TODO: remove debug info $qe
            return redirect(route('brands'))->withErrors(['update' => 'Не можливо змінити назву виробника.' . $qe->getMessage()]);
        }
        Log::info('Brand update', ['user' => $user]);
//        session()->flash('msg', 'Назву виробника успішно змінено!');
        return redirect(route('brands'))->with('msg','Назву виробника успішно змінено!');
    }

}
