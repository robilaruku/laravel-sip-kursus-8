<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
use Redirect;

class CategoryController extends Controller
{
    // menampilkan semua data
    public function index() {
        $category = \App\Models\Category::get();
        return view('admin.category.index', compact('category'));
    }
    // menampilkan form tambah
    public function create() {
        return view('admin.category.create');
    }

    // untuk save ke database
    public function store(Request $request) {
        // membuat validasi
        $rules = [
            'name'      => 'required',
            'status'    => 'required'
        ];
        $messages = [
            'name.required'     => 'Nama tidak boleh kosong',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect('admin/category/create')->withErrors($validator);
        } else {
            // Save to database
            $category = new \App\Models\Category;
            $category->name = $request->input('name');
            $category->status = $request->input('status');
            $category->save();

            Session::flash('message', 'Kategori berhasil ditambah');

            return redirect('admin/category');
        }
    }

    public function edit($id) {
        $category = \App\Models\Category::find($id);

        return view('admin.category.edit', compact('category'));
    }

    // untuk save ke database
    public function update(Request $request, $id) {
        // membuat validasi
        $rules = [
            'name'      => 'required',
            'status'    => 'required'
        ];
        $messages = [
            'name.required'     => 'Nama tidak boleh kosong',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect('admin/category/create')->withErrors($validator);
        } else {
            // Save to database
            $category = \App\Models\Category::find($id);
            $category->name = $request->input('name');
            $category->status = $request->input('status');
            $category->save();

            Session::flash('message', 'Kategori berhasil ditambah');

            return redirect('admin/category');
        }
    }

    public function show($id) {
        $category = \App\Models\Category::find($id);

        return view('admin.category.show', compact('category'));
    }

    public function destroy($id) {
        $category = \App\Models\Category::find($id);
        $category->delete();

        Session::flash('message', 'Data berhasil dihapus');
        return redirect('admin/category');
    }
}
