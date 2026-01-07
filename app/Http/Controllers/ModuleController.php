<?php
/**
 * @Author: Anwarul
 * @Date: 2026-01-05 15:04:23
 * @LastEditors: Anwarul
 * @LastEditTime: 2026-01-07 14:41:02
 * @Description: Innova IT
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
    {
        $request->validate([
           'title' => 'required',
           'course_id' => 'required',
        ]);

        Module::create([
           'title' => $request->title,
           'course_id' => $request->course_id,
        ]);
        return back()->with('success', 'Module Create successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ]);

        Module::find($id)->update([
            'title' => $request->title,
        ]);

        return back()->with('success', 'Module updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module)
    {
        // delete all others related to this module
        // Video::where('module_id', $module->id)->delete();
        $module->delete();
         return back()->with('success', 'Module Deleted successfully');
    }
}
