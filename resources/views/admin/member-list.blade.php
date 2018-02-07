@extends('admin.common.layout')

@section('content')
<div class="content-wrapper">
  <div class="page-title">
    <div>
      <h1>Data Table</h1>
      <ul class="breadcrumb side">
        <li><i class="fa fa-home fa-lg"></i></li>
        <li>Tables</li>
        <li class="active"><a href="#">Data Table</a></li>
      </ul>
    </div>
    <div><a class="btn btn-primary btn-flat" href="#"><i class="fa fa-lg fa-plus"></i></a><a class="btn btn-info btn-flat" href="#"><i class="fa fa-lg fa-refresh"></i></a><a class="btn btn-warning btn-flat" href="#"><i class="fa fa-lg fa-trash"></i></a></div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th>id</th>
                <th>openid</th>
                <th>姓名</th>
                <th>会员等级</th>
                <th>手机号码</th>
                <th>收货地址</th>
                <th>他的店铺</th>
                <th>账户余额</th>
                <th>操作</th>

              </tr>
            </thead>
            <tbody>
                @forelse($data as $val)
                <tr>
                  <td>{{$val->id}}</td>
                  <td>{{$val->openid}}</td>
                  <td>{{$val->memberinfo->wx_nickname}}</td>
                  <td>@if($val->rank == 1) 会员 @else 一般用户 @endif</td>
                  <td>@if($val->memberinfo->phone){{$val->memberinfo->phone}} @else 未认证 @endif</td>
                  <td>@if($val->defaultaddr) {{$val->defaultaddr->full_address }} @else 未填写 @endif</td>
                  <td>@if($val->store)<a href="/store/view/{{$val->id}}">{{$val->store->store_name}}</a>@else 未开通店铺@endif</td>
                  <td>{{$val->money}}</td>
                  <td><a href=""><i class="fa fa-edit"></i></a> <a href=""><span class="fa fa-delete-o"></span></a></td>

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
