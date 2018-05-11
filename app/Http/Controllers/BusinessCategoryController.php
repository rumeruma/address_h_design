<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BusinessCategory;

class BusinessCategoryController extends Controller
{

    public function __construct(){
        $this->middleware('auth:admin');
        $this->middleware('admin');

    }

    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Http\Response

     */

    public function manageCategory($edit = "")

    {

        $categories = BusinessCategory::whereParentId(0)->get();

        $allCategories = BusinessCategory::all();
        if($edit == "manage"){
            return view('business-profile.edit',compact('categories','allCategories'));
        } else {
            return view('business-profile.manageCategory',compact('categories','allCategories'));
        }


    }


    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Http\Response

     */

    public function addCategory(Request $request)

    {

        $this->validate($request, [

            'title' => 'required|unique:business_categories',

        ]);

        $parent = $request->input('parent_id');

        $bc = new BusinessCategory();
        $bc->title = $request->input('title');
        $bc->name = str_slug($request->input('title'));
        $bc->parent_id = ($parent == "") ? 0 : $parent;
        $bc->save();

        return back()->with('success', 'New Category added successfully.');

    }

    public function update(Request $request, BusinessCategory $bc){

//        return $request->all();
        $this->validate($request, [
            'title' => 'required|unique:business_categories',
        ]);
        $name = $bc->title;
        $bc->title = $request->input('title');
        $bc->name = str_slug($request->input('title'));
        $bc->save();

        return redirect(route('business.category'))
            ->with('status', 'Category <strong>'.$name.'</strong> has been successfully renamed to <strong>'.$bc->title.'</strong>');
    }

    public function destroy($id)
    {
        $category = BusinessCategory::find($id);
        $name = $category->title;
        $and = '';
        if($category->parent_id !=0){
            //i am child
            $category->delete();
        }else{
            //i am parent
            BusinessCategory::where('parent_id', $category->id)->delete();
            $category->delete();
            $and = ' and its childs ';
        }
        return redirect(route('business.category'))
            ->with('status', 'Category <strong>'.$name.$and.'</strong> has been deleted successfully');
    }
}
