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
                <th>账户名</th>
                <th>身份</th>
                <th>创建时间</th>
                <th>上次更改时间</th>
                <th>操作</th>

              </tr>
            </thead>
            <tbody>
                @forelse($data as $val)
                <tr>
                  <td>{{$val->id}}</td>
                  <td>{{$val->username}}</td>
                  <td>{{$val->roleinfo->name}}</td>
                  <td>{{$val->created_at}}</td>
                  <td>{{$val->updated_at}}</td>
                  <td><a href=""><i class="fa fa-edit"></i></a> <a href=""><span class="fa fa-trash-o"></span></a></td>

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
