<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use Illuminate\Http\Request;
use Validator;
use Session;

class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Session::put('page','cms-pages');
        $cms_pages = CmsPage::get();

        return view('admin.pages.cms_pages')->with(compact('cms_pages'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CmsPage $cmsPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id = null)
    {
        if($id == '') {
            $title = 'Add CMS Page';
            $cmsPage = new CmsPage;
            $message = 'CMS Page Added successfully';
        } else {
            $title = 'Edit CMS Page';
        }

        if($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'title' => 'required',
                'url' => 'required',
                'description' => 'required',
            ];
            $customMessages = [
                'title.required' => 'Title is required',
                'url.required' => 'URL is required',
                'description.required' => 'Description is required',
            ];
            $request->validate($rules, $customMessages);

            $cmsPage->title = $data['title'];
            $cmsPage->url = $data['url'];
            $cmsPage->description = $data['description'];
            $cmsPage->status = 1;
            $cmsPage->save();
            return redirect('admin/cms-pages')->with('success_message', $message);
        }

        return view('admin.pages.add_edit_cmspage')->with(compact('title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CmsPage $cmsPage)
    {
        if($request->ajax()) {
            $data = $request->all();

            if($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            CmsPage::where('id', $data['page_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'page_id' => $data['page_id']]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CmsPage $cmsPage)
    {
        //
    }
}
