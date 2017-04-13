<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Record;
use Illuminate\Support\Facades\DB;
use App\Http\Model\User;

class RecordController extends FormController {

    public function index(Request $request, $status = 0) {
        $search = request("search", $default = "");
        
        $datas = Record::where(function($query)use($status) {
                    if ($status) {
                        $query->where("status", $status);
                    }
                })->where(function($query)use($search) {
                    if ($search) {
                        $query->where("send_tel", "like", "%" . $search . "%");
                    }
                })->orderBy("id", "desc")->paginate(10);
        $datas->appends(['search' => $search])->render();
        
        return view("admin.record.index", compact("datas", "status", "search"));
    }

}
