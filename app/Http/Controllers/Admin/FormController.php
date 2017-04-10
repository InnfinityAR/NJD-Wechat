<?php

/**
 * @author xuxin@canchance.com
 * @access public
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use App\Http\Model\Admin\Category;
use Illuminate\Support\Facades\DB;

class FormController extends CommonController {

    

    public function __construct() {
        parent::__construct();
        // TODO:做一些基础的判断，如果没有的话就抛出异常
        
        
       
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $models = new $this->model;
        $input = $request->except('_token');
        $has_key = array_key_exists('search', $input);
        if($has_key){
            $search = $input["search"];
        }else{
            $search = "";
        }
        if ($search) {
            //分页追加参数
            $datas = $models::orderBy('id', 'desc')->where('name', 'like', '%' . $input['search'] . '%')->paginate(10);
            $datas->appends(['search' => $input['search']])->render();
        } else {
            $datas = $models::orderBy('id', 'desc')->paginate(10);
        }
        return view('admin.' . strtolower($this->controller) . '.index', compact('datas','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.' . strtolower($this->controller) . '.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $model = new $this->model;
        $input = $request->except(['_token']);

        if (array_key_exists('pub_time', $input)) {
            if (empty($input['pub_time'])) {
                $input['pub_time'] = time();
            } else {
                $input['pub_time'] = strtotime($input['pub_time']);
            }
        }
        if (array_key_exists('time', $input)) {
            if (empty($input['time'])) {
                $input['time'] = time();
            } else {
                $input['time'] = strtotime($input['time']);
            }
        }
        
        
        if (array_key_exists('name', $input)) {
            $rules = [
                'name' => 'required',
            ];

            $message = [
                'name.required' => '名称不能为空！',
            ];
        } else {
            $rules = $message = [];
        }
        
        $validator = Validator::make($input, $rules, $message);

        if ($validator->passes()) {
            $re = $model::create($input);
            
            if ($re) {
                $back["status"] = 1;
                $back["msg"] = "数据添加成功!";
            } else {
                $back["status"] = 0;
                $back["msg"] = "数据添加失败!";
            }
        } else {
            $back["msg"] = $validator->errors()->first();
            $back["status"] = 0;
        }
        return $back;
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $model = new $this->model;
        $field = $model::find($id);
        return view('admin.' . strtolower($this->controller) . '.edit', compact('field'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $model =new $this->model;
        $input = $request->except('_token', '_method');
        
        //如果表单有时间
        if (array_key_exists('pub_time', $input)) {
            //如果表单时间为空，当前时间，不为空转换时间
            if (empty($input['pub_time'])) {
                $input['pub_time'] = time();
            } else {
                $input['pub_time'] = strtotime($input['pub_time']);
            }
        }
        if (array_key_exists('time', $input)) {
            if (empty($input['time'])) {
                $input['time'] = time();
            } else {
                $input['time'] = strtotime($input['time']);
            }
        }
        $re = $model::where("id",$id)->update($input);
        if ($re!==false) {
            $back["status"] = 1;
            $back["msg"] = "数据修改成功";
        } else {
            $back["status"] = 0;
            $back["msg"] = "数据修改失败";
            
        }
        return $back;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $model = new $this->model;
        if(is_string($id)){
            $ids = explode(",", $id);
            
            $re = $model::whereIn('id', $ids)->delete();
        }else{
            
            $re = $model::where('id', $id)->delete();
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
