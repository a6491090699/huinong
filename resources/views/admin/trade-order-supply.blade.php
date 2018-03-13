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
                <th>订单号</th>
                <th>商品</th>
                <th>收货人</th>
                <th>下单日期</th>
                <th>订单状态</th>
                <th>保证金</th>
                <th>编辑</th>

              </tr>
            </thead>
            <tbody>
                @forelse($data as $val)
                <tr>
                  <td>{{$val->id}}</td>
                  <td>{{$val->order_sn}}</td>
                  <td>{{$val->supply->goods_name}}</td>
                  <td>{{$val->reciever}}</td>
                  <td>{{date('Y-m-d H:i', $val->addtime)}}</td>
                  <td>{{getStatus($val->status)}}</td>
                  <td>{{$val->pay_bzj == 1? '已缴纳':'未缴纳'}}</td>
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
