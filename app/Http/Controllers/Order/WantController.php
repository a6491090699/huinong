<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Want;
use App\Model\WantAttr;
use App\Model\MemberAddress;

class WantController extends Controller
{
    //求购大厅列表
    public function index(){
        // $data = Want::with('wantAttrs')->get();
        // dump(Want::with('wantAttrs.attrs.kinds')->get()->toArray());
        // dump(WantAttr::with('attrs')->get()->toArray());
        // dump($data);
        //
        // // dump($data->want_attrs);
        // foreach ($data as $book) {
        //     dump($book->wantAttrs);
        // }
        //
        // dump($data->toArray());
        //
        //
        //
        // exit;
        return view('home.want.index');
    }

    public function uploadfile(Request $request)
    {
        //要让文件能被访问到 php artisan storage:link 然后 huinong.app/storage/hehe.png
        $filepath = session('mid');
        //自动生成文件名
        $path = $request->file('imgs')->store('public/want/'.$filepath);
        //手动生成文件名
        // $path = $request->file('imgs')->storeAs('public/want/',session('mid').'_'.date('YmdHis').'jpg');
        // /public/2017/10/18/J9bL2J8TQmuvLhRdYVhZxDcfYivv9cNEojANs1zY.png
        // return str_replace('public','storage', $path);
        return $path;

    }

    //发布求购 增
    public function fabu(Request $request){
        // $this->validate();
        // exit;
        // return back()->withErrors(['email'=>'sdhfdsuifhu']);exit;
        if($request->isMethod('post'))
        {
            //表单提交
            // dump($_FILES);
            // dd($request->all());
            $miaoy = $request->input('miaoy');
            $from_region_names = $request->input('from_region_names');
            $cate_id = $request->input('cate_id');
            $cate_name = $request->input('cate_name');
            $title = $request->input('title');
            $requirement_spec = $request->input('requirement_spec');
            $address_option = $request->input('address_option');
            $address_id = $request->input('address_id');
            $description = $request->input('description');
            $emergency = $request->input('emergency');
            $expire = $request->input('expire');

            // 地址 自填 还是选择
            if($miaoy == '1')
            {
                //自己填写
                $from_region_id = $request->input('from_region_id');
                $from_region_names = $request->input('from_region_names');


            }elseif($miaoy == '2'){
                //选择框
                $from_region_id = $request->input('from_region_id');
                $from_region_names = $request->input('from_region_names');
                $region_name_select = $request->input('region_name_select');


            }else{
                dd('error');
            }

            // $imgs

            $imgs = $this->uploadfile($request);


            $number = $requirement_spec['num'][0];

            $obj = new Want;
            $obj->source = $from_region_names;
            $obj->title = $title;
            $obj->number =$number;
            $obj->imgs = $imgs;
            $obj->tip =$description;
            $obj->is_emergency = $emergency;
            $obj->cutday = strtotime($expire);
            $obj->status = 0;
            $obj->kid = $cate_id;
            $obj->member_id = session('mid');
            $obj->addtime = time();
            $obj->region_id = $from_region_id;
            $obj->address = $address_option;
            $obj->address_id = $address_id;


            $attr = $requirement_spec['attr'];
            if($obj->save() && $attr){
                $wants_id = $obj->id;

                foreach($attr as $key=>$v){
                    $att = new WantAttr;
                    $att->attribute_id = $key;
                    $att->attr_value = $v[0];
                    $att->wants_id = $wants_id;
                    $att->save();
                }
            }

            return response("<script>alert('发布成功!');location.href='/want/index'</script>");
            // attr spec
            //把属性加到 wantattr 里面


        }


        //调用我的地址里面的联系人

        // $data = \App\Model\MemberAddress::where('mid' , session('mid'))->get(['full_address','region_id','street'])->toArray();
        // $address = array();
        // foreach($data as $val){
        //     $newarr = array();
        //     $newarr['id']=$val['region_id'];
        //     $newarr['name']=$val['full_address']."\t".$val['street'];
        //     $address[] = $newarr;
        // }
        // $address_json = json_encode($address);




        //调用我的店铺 所填写的基地
        $data = \App\Model\MemberStoreinfo::where('member_id' , session('mid'))->first(['base_address','region_id','street'])->toArray();
        $address = array();
        $address['id'] = $data['region_id'];
        $address['name'] = $data['base_address']."\t".$data['street'];

        $address_json = (json_encode($address));

        return view('home.want.fabu',['address_json'=>$address_json]);
    }

    //删除求购
    public function delWant($wid)
    {
        $rs = Want::where('id',$wid)->delete();
        if($rs) return back()->with('del_msg' , '删除成功');
    }

    //查看求购
    public function view()
    {


    }


    //编辑求购

    public function eidt($wid)
    {

    }
    public function delete($wid)
    {

    }

    //我的求购
    public function myWant()
    {
        // $data = Want::with()->where('member_id',session('mid'))->get();
        $mid = session('mid');
        return view('home.want.my-want',['mid'=>$mid]);
    }





    //




}
