<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Residentialarea;
use Illuminate\Support\Facades\DB;
use App\Http\Model\District;

class ResidentialareaController extends FormController {

    public function index(Request $request) {
        $search = request("search", $default = "");

        $datas = Residentialarea::where(function($query)use($search) {
                    if ($search) {
                        $query->where("residentialname", "like", "%" . $search . "%");
                    }
                })->orderBy("residentialid", "desc")->paginate(10);
        $datas->appends(['search' => $search])->render();
        
        return view("admin.residentialarea.index", compact("datas", "status", "search"));
    }
    
    public function create() {
        $districts = District::all();
        return view("admin.residentialarea.add", compact("districts"));
    }
    
    public function store(Request $request) {
       $input = $request->except(['_token']);
       $input["updatedate"] = $input['creationdate'] = date("Y-m-d H:i:s",time());
       
       $res = Residentialarea::create($input);
            
        if ($res) {
            $back["status"] = 1;
            $back["msg"] = "数据添加成功!";
        } else {
            $back["status"] = 0;
            $back["msg"] = "数据添加失败!";
        }
        return $back;
    }

    public function edit($id) {
        $model = new Residentialarea;
        $field = $model::where("residentialid", $id)->first();
        $districts = District::all();
        return view('admin.' . strtolower($this->controller) . '.edit', compact('field', "districts"));
    }
    
    public function update(Request $request, $id) {
        $input = $request->except('_token', '_method');
        $input['updatedate'] = date("Y-m-d H:i:s",time());
        
        $res = Residentialarea::where("residentialid",$id)->update($input);
        if ($res!==false) {
            $back["status"] = 1;
            $back["msg"] = "数据修改成功";
        } else {
            $back["status"] = 0;
            $back["msg"] = "数据修改失败";
            
        }
        return $back;
    }
    
    public function destroy($id) {
       
        if(is_string($id)){
            $ids = explode(",", $id);
            
            $re = Residentialarea::whereIn('residentialid', $ids)->delete();
        }else{
            
            $re = Residentialarea::where('residentialid', $id)->delete();
        }
        
        if ($re) {
            $data = [
                'status' => 1,
                'msg' => '删除成功！',
            ];
        } else {
            $data = [
                'status' => 0,
                'msg' => '删除失败，请稍后重试！',
            ];
        }
        return $data;
    }
    
}
