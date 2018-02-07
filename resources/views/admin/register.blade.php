@extends('admin.common.layout')

@section('title' , '添加管理员')

@section('content')
<div class="content-wrapper">
    <form action="/admin/register" method="post">
        {{csrf_field()}}
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <h3 class="card-title">添加管理员</h3>
          <div class="card-body">
              <div class="form-group">
                <label class="control-label">账号</label>
                <input class="form-control" type="text" placeholder="请输入账号" name="username">
              </div>
              <div class="form-group">
                <label class="control-label">密码</label>
                <input class="form-control" type="password" placeholder="请输入密码" name="password">
              </div>
              <div class="form-group">
                <label class="control-label">身份</label>
                <select class="form-control" name="role">

                    @foreach(DB::select('select * from admin_roles') as $val)
                  <option value="{{$val->id}}">{{$val->name}}</option>
                  @endforeach
                 
                </select>
              </div>




          </div>
          <div class="card-footer">
            <button class="btn btn-primary icon-btn" type="button" onclick="$('form').submit()"><i class="fa fa-fw fa-lg fa-check-circle"></i>添加</button>&nbsp;&nbsp;&nbsp;
          </div>
        </div>
      </div>

      <div class="clearix"></div>

    </div>
    </form>
</div>

@endsection
