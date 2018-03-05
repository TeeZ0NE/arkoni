<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException as QE;
use App\Models\Attribute as Attr;
use Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelFail;

class AttributesController extends AbstractQueryController
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
            'name_ru' => "max:255|unique:attributes|required",
            'name_uk' => "max:255|unique:attributes|required",
        ]);
        $attr = new Attr;
        $attr->name_ru = $request->name_ru;
        $attr->name_uk = $request->name_uk;
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
        if (empty($q)) {
            $attrs = Attr::orderBy('name_ru', $sort)
                ->paginate($this->pag_count);
        } else {
            $attrs = Attr::where('name_ru', 'LIKE', '%' . $q . '%')
                ->orWhere('name_uk', 'LIKE', '%' . $q . '%')
                ->orderBy('name_ru', $sort)
                ->orderBy('name_uk', $sort)
                ->paginate($this->pag_count);
        }
        return view('admin.pages.attributes')
            ->with([
                'attrs' => $attrs,
                'count' => Attr::count(),
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
            'name_ru' => "max:255|required",
            'name_uk' => "max:255|required"
        ]);
        $attr = Attr::find($request->id);
        $attr->name_ru = $request->name_ru;
        $attr->name_uk = $request->name_uk;
        try {
            $attr->save();
        } catch (QE $qe) {
            //TODO::delete debug info $qe
            return redirect()->back()->withErrors(['update' => 'Не можливо змінити назву параметра.' . $qe->getMessage()]);
        }
        session()->flash('msg', 'Назву параметра успішно змінено!');
        return redirect()->back();
    }
}
