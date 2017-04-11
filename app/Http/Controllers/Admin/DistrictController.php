<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\District;
use Illuminate\Support\Facades\DB;

class DistrictController extends FormController {

    public function index(Request $request) {
        $search = request("search", $default = "");

        $datas = District::where(function($query)use($search) {
                    if ($search) {
                        $query->where("districtname", "like", "%" . $search . "%");
                    }
                })->orderBy("districtid", "desc")->paginate(10);
        $datas->appends(['search' => $search])->render();
        
        return view("admin.district.index", compact("datas", "status", "search"));
    }
    
    public function store(Request $request) {
       $input = $request->except(['_token']);
       $input["updatedate"] = $input['creationdate'] = date("Y-m-d H:i:s",time());
       
       $res = District::create($input);
            
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
        $model = new District;
        $field = $model::where("districtid", $id)->first();
        return view('admin.' . strtolower($this->controller) . '.edit', compact('field'));
    }
    
    public function update(Request $request, $id) {
        $input = $request->except('_token', '_method');
        $input['updatedate'] = date("Y-m-d H:i:s",time());
        
        $res = District::where("districtid",$id)->update($input);
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
            
            $re = District::whereIn('districtid', $ids)->delete();
        }else{
            
            $re = District::where('districtid', $id)->delete();
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
