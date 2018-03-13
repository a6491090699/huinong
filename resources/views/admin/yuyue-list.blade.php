@extends('admin.common.layout')

@section('content')
<div class="content-wrapper">
  @include('admin.common.breadcrumb')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th>id</th>
                <th>预约商品名称</th>
                <th>预约状态</th>
                <th>开始时间</th>
                <th>结束时间</th>
                <th>联系人</th>
                <th>联系号码</th>
                <th>留言</th>
                <th>编辑</th>

              </tr>
            </thead>
            <tbody>
                @forelse($data as $val)
                <tr>
                  <td>{{$val->id}}</td>
                  <td>{{$val->supply->goods_name}}</td>
                  <td>{{getYuyueStatus($val->status)}}</td>
                  <td>{{$val->start_data}}</td>
                  <td>{{$val->end_data}}</td>
                  <td>{{$val->name}}</td>
                  <td>{{$val->phone}}</td>
                  <td>{{$val->message}}</td>
                  <td><a href="" title="编辑"><i class="fa fa-edit"></i></a>&nbsp;&nbsp; <a href="" title="删除"><span class="fa fa-trash-o"></span></a></td>
                </tr>
                @empty
                <tr>
                    <td>没东西</td>
                </tr>
                @endforelse

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">$('#sampleTable').DataTable();</script>

@endsection
