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
                <th>会员订单</th>


              </tr>
            </thead>
            <tbody>
                @forelse($data as $val)
                <tr>
                  <td>{{$val->id}}</td>
                  <td>{{$val->openid}}</td>
                  <td>{{$val->memberinfo->wx_nickname}}</td>
                  <td>@if($val->rank == 1) 会员 @else 一般用户 @endif</td>
                  <td>
                      &nbsp;&nbsp;&nbsp;
                      <a href="/admin/trade-order?type=supply&mid={{$val->id}}" title="供货订单">供货订单</a> &nbsp;&nbsp;&nbsp;
                      <a href="/admin/trade-order?type=buy&mid={{$val->id}}" title="采购订单">采购订单</a>&nbsp;&nbsp;&nbsp;
                      <a href="/admin/trade-order?type=good&mid={{$val->id}}" title="ta的商品">ta的商品</a>&nbsp;&nbsp;&nbsp;
                      <a href="/admin/trade-order?type=want&mid={{$val->id}}" title="ta的求购">ta的求购</a>&nbsp;&nbsp;&nbsp;
                      <a href="/admin/trade-order?type=quote&mid={{$val->id}}" title="ta的报价">ta的报价</a>&nbsp;&nbsp;&nbsp;
                      <a href="/admin/trade-order?type=yuyue&mid={{$val->id}}" title="ta的预约看货">ta的预约看货</a>
                  </td>


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
