<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException as QE;
use App\Models\Attribute as Attr;
use Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;


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
        $user = Auth::user()->name;
        try {
            $attr->save();
        } catch (QE $qe) {
            Log::error("Can't store attributes", ['mes' => $qe->getMessage(), 'user' => $user]);
            return redirect()
                ->back()
                ->withErrors(['name' => 'Такий параметр вже існує']);
        }
        Log::info('Attributes add', ['user' => $user]);
        return redirect(route('attrs'))->with('msg', 'Параметр додано');
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
        $user = Auth::user()->name;
        try {
            Attr::findOrFail($request->id)->delete();
        } catch (QE $qe) {
            Log::error("Can't delete attributes", [
                'mes' => $qe->getMessage(),
                'user' => $user]);
            return redirect()->back()->withErrors(['attr_name' => 'Виникла проблема з видаленням параметра. Вірогідно він використовується в продуктах.']);
        }
        Log::info('Attributes delete', ['user' => $user]);
        return redirect(route('attrs'))->with('msg', 'Параметр видалено з бази');
    }

    public function update(Request $request)
    {
        $request->validate([
            'ru_name' => "max:255|required",
            'uk_name' => "max:255|required"
        ]);
        $user = Auth::user()->name;
        $attr = Attr::where('id', $request->id)
            ->update(['ru_name' => $request->ru_name,
                'uk_name' => $request->uk_name]);
        if (!$attr) {
            Log::warning("Can't update Attribute", ['user' => $user]);
            return redirect()->back()->withErrors(['update' => 'Не можливо змінити назву параметра.']);
        } else {
            Log::info("Attributes updated", ['user' => $user]);
            return redirect(route('attrs'))->with('msg', 'Параметр змінено');
        }
    }
}
