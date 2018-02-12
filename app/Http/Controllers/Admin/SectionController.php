<?php
/**
 * Created by PhpStorm.
 * User: ndalaba
 * Date: 26/05/15
 * Time: 10:17
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Section;
use App\Http\Models\Help;
use Illuminate\Http\Request;

class SectionController extends Controller {

    public function __construct() {
        $this->middleware('administration');
    }

    //SECTIONS
    public function getSections($id = 0) {
        $section = new Section();
        if ($id != 0)
            $section = Section::find($id);
        $sections = Section::orderBy('section')->get();

        return view('admin.reglages.section')->with('section', $section)->with('sections', $sections);
    }

    public function getSection($id = 0) {
        $section = Section::find($id);
        $sections = Section::orderBy('section')->get();
        if ($section == null)
            $section = new Section();
        return view('admin.reglages.section')->with('section', $section)->with('sections', $sections);
    }

    public function postCreateSection(Request $request) {
        if ($request->isMethod('post')) {
            $error = "";
            if (Help::checkObject(new Section(), 'section', $request->input('section'), $request->input('id', 0)))
                $error = "Section déja enregistré";

            if (strlen(trim($error)) > 0)
                return redirect("admin/sections/section")->withInput()->with("error", $error);
            $slug = str_slug($request->input('section'));
            $request->merge(array('slug' => $slug));
            Section::create($request->all());
            return redirect('admin/sections/sections');
        }
    }

    public function putUpdateSection(Request $request) {
        if ($request->isMethod('put')) {
            $error = "";
            if (Help::checkObject(new Section(), 'section', $request->input('section'), $request->input('id', 0)))
                $error = "Section déja enregistré";

            if (strlen(trim($error)) > 0)
                return redirect("admin/sections/section")->withInput()->with("error", $error);
            $id = $request->input('id');
            $slug = str_slug($request->input('section'));
            $request->merge(array('slug' => $slug));
            Section::find($id)->update($request->all());
            return redirect('admin/sections/sections');
        }
    }

    public function getSectionDelete($id, Request $request) {
        //$ids = $request->input($id);
        Section::destroy($id);
        return redirect('admin/sections/sections');
    }
}
