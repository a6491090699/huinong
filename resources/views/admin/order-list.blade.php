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
                <th>订单号</th>
                <th>用户</th>
                <th>商品名称</th>
                <th>单价</th>
                <th>数量</th>
                <th>规格</th>
                <th>总价(元)</th>
                <th>操作</th>

              </tr>
            </thead>
            <tbody>
                @forelse($data as $val)
                <tr>
                  <td>{{$val['id']}}</td>
                  <td>{{$val['order_sn']}}</td>
                  <td>{{$val['userinfo']['wx_nickname']}}</td>
                  <td>{{$val['supply']['goods_name']}}</td>
                  <td>{{$val['supply']['price']}}</td>
                  <td>{{$val['number']}}</td>
                  <td>
                      @foreach($val['supply']['supply_attrs'] as $v)
                        {{$v['attrs']['attr_name']}}:{{$v['attr_value']}}{{$v['attrs']['unit']}}
                      @endforeach

                  </td>
                  <td>{{$val['total_price']}}</td>
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
