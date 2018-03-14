<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException as QE;
use App\Models\Attribute as Attr;
use Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelFail;

class AttributesController extends Controller
{
    private $pag_count = 10;

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin.pages.attributes')
            ->with([
                'attrs' => Attr::paginate($this->pag_count),
                'count' => Attr::count(),
                'sort' => 'acs']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'ru_name' => "max:255|unique:attributes|required",
            'uk_name' => "max:255|unique:attributes|required",
        ]);
        $attr = new Attr;
        $attr->ru_name = $request->ru_name;
        $attr->uk_name = $request->uk_name;
        try {
            $attr->save();
        } catch (QE $qe) {
            //TODO: remove debug info $qe
            return redirect()
                ->back()
                ->withErrors(['name' => 'Такий параметр вже існує' . $qe->getMessage()]);
        }
        session()->flash('msg', 'Параметр додано');
        return redirect()->back();
    }

    public function search(Request $request)
    {
        $request->flash();
        $sort = $request->sort;
        $q = $request->q;
        $attr = new Attr();
        return view('admin.pages.attributes')
            ->with([
                'attrs' => $attr->searchAndSort($q, $sort)->paginate($this->pag_count),
                'count' => $attr::count(),
                'sort' => $sort]);
    }

    public function delete(Request $request)
    {
        try {
            Attr::findOrFail($request->id)->delete();
        } catch (QE $qe) {
            //TODO: remove debug $qe
            return redirect()->back()->withErrors(['attr_name' => 'Виникла проблема з видаленням параметра. Вірогідно він використовується в продуктах.' . $qe->getMessage()]);
        }
        session()->flash('msg', 'Параметр видалено з бази');
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $request->validate([
            'ru_name' => "max:255|required",
            'uk_name' => "max:255|required"
        ]);
        $attr = Attr::where('id',$request->id)
        ->update(['ru_name' => $request->ru_name,
        'uk_name' => $request->uk_name]);
        if(!$attr) {
            return redirect()->back()->withErrors(['update' => 'Не можливо змінити назву параметра.']);
        }else {
            session()->flash('msg', 'Назву параметра успішно змінено!');
            return redirect()->back();
        }
    }
}
