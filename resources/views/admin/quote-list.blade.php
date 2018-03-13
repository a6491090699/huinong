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
                <th>报价商品标题</th>
                <th>报价价格</th>
                <th>数目</th>
                <th>备货时间(天)</th>
                <th>报价时间</th>
                <th>编辑</th>

              </tr>
            </thead>
            <tbody>
                @forelse($data as $val)
                <tr>
                  <td>{{$val->id}}</td>
                  <td>{{$val->wants->title}}</td>
                  <td>{{$val->price}}</td>
                  <td>{{$val->number}}</td>
                  <td>{{$val->beihuo_time}}</td>
                  <td>{{date('Y-m-d H:i' , $val->addtime)}}</td>
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
