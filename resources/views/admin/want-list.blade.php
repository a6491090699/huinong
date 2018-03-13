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
                <th>采购标题</th>
                <th>用苗地</th>
                <th>数量</th>
                <th>截止日期</th>
                <th>发布日期</th>
                <th>编辑</th>

              </tr>
            </thead>
            <tbody>
                @forelse($data as $val)
                <tr>
                  <td>{{$val->id}}</td>
                  <td>{{$val->title}}</td>
                  <td>{{$val->source}}</td>
                  <td>{{$val->number}}</td>
                  <td>{{date('Y-m-d H:i', $val->cutday)}}</td>
                  <td>{{date('Y-m-d H:i', $val->addtime)}}</td>
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
