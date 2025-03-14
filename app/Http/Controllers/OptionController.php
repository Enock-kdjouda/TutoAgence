<?php

namespace App\Http\Controllers;

use App\Http\Requests\OptionFormRequest;
use Illuminate\Http\Request;
use App\Models\Option;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.options.index',[
            'options' => Option::paginate(25)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $option = new Option();
        $option-> fill([
            'name' => '',
        ]);
        return view('admin.options.form', [
            'option' => $option
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OptionFormRequest $request)
    {
        $option = Option::create($request->validated());
        return to_route('admin.option.index')->with('success', 'option bel et bien créé  ');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(option $option)
    {
        return view('admin.options.form',[
            'option' => $option
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OptionFormRequest $request, option $option)
    {
        $option -> Update($request->validated());
        return to_route('admin.option.index')->with('success', 'option bel et bien modifié ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(option $option)
    {
        $option -> delete();
        return back()->with('success', 'option bel et bien supprimé ');
    }
}
