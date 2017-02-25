<?php

namespace App\Http\Controllers\Admin;

use App\Model\Config;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ConfigController extends Controller
{
    //get.admin/config  全部配置项列表
    public function index()
    {
        $data = Config::orderBy('order','asc')->get();
        foreach($data as $k=>$v){
            switch ($v->type){
                case 'input':
                    $data[$k]->_html = '<input type="text" class="lg" name="content[]" value="'.$v->content.'">';
                    break;
                case 'textarea':
                    $data[$k]->_html = '<textarea type="text" class="lg" name="content[]">'.$v->content.'</textarea>';
                    break;
                case 'radio':
                    //1|开启,0|关闭
                    $arr = explode(',',$v->value);
                    $str = '';
                    foreach($arr as $m=>$n){
                        //1|开启
                        $r = explode('|',$n);
                        $c = $v->content==$r[0]?' checked ':'';
                        $str .= '<input type="radio" name="content[]" value="'.$r[0].'"'.$c.'>'.$r[1].'　';
                    }
                    $data[$k]->_html = $str;
                    break;
            }
        }
        return view('admin.config.index',compact('data'));
    }

    public function changeOrder()
    {
        $input = Input::all();
        $config = Config::find($input['id']);
        $config->order = $input['order'];
        $re = $config->update();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '配置项排序更新成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '配置项排序更新失败，请稍后重试！',
            ];
        }
        return $data;
    }

    public function changeContent()
    {
        $input = Input::all();
        foreach($input['id'] as $k=>$v){
            Config::where('id',$v)->update(['content'=>$input['content'][$k]]);
        }
        $this->putFile();
        return back()->with('errors','配置项更新成功！');
    }


    public function putFile()
    {
        $config = Config::pluck('content','name')->all();
        $path = base_path().'\config\web.php';
        $str = '<?php return '.var_export($config,true).';';
        file_put_contents($path,$str);
    }

    //get.admin/config/create   添加配置项
    public function create()
    {
        return view('admin/config/add');
    }

    //post.admin/config  添加配置项提交
    public function store()
    {
        $input = Input::except('_token');
        $rules = [
            'name'=>'required',
            'title'=>'required',
        ];

        $message = [
            'name.required'=>'配置项名称不能为空！',
            'title.required'=>'配置项标题不能为空！',
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()){
            $re = Config::create($input);
            if($re){
                return redirect('admin/config');
            }else{
                return back()->with('errors','配置项失败，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    //get.admin/config/{config}/edit  编辑配置项
    public function edit($id)
    {
        $field = Config::find($id);
        return view('admin.config.edit',compact('field'));
    }

    //put.admin/config/{config}    更新配置项
    public function update($id)
    {
        $input = Input::except('_token','_method');
        $re = Config::where('id',$id)->update($input);
        if($re){
            return redirect('admin/config');
        }else{
            return back()->with('errors','配置项更新失败，请稍后重试！');
        }
    }

    //delete.admin/config/{config}   删除配置项
    public function destroy($id)
    {
        $re = Config::where('id',$id)->delete();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '配置项删除成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '配置项删除失败，请稍后重试！',
            ];
        }
        return $data;
    }


    //get.admin/category/{category}  显示单个分类信息
    public function show()
    {

    }

    public function test()
    {
        $test = Config::pluck('content','name')->all();
//        dd($test);
        $one = Config::select('content','name')->get();
        return $one;
        exit();
    }

}
