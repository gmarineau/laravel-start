@extends('layouts.admin')

@section('breadcrumb')
  <li class="breadcrumb-item active">
    <a href="{{ route('admin.users.index') }}">Users</a>
  </li>
@stop

@section('content')

  <div class="card mb-3">
    <div class="card-header">
      Users
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <tr>
            <th>Name</th>
            <th class="text-center">E-mail</th>
            <th class="text-center">Created at</th>
            <th class="text-center">Rôles</th>
            <th></th>
          </tr>
          @foreach ($users as $user)
            <tr>
              <td>{{ $user->full_name }}</td>
              <td class="text-center">{{ $user->email }}</td>
              <td class="text-center">{{ $user->created_at->format('d.m.Y') }}</td>
              <td class="text-center">
                @foreach ($user->roles as $role)
                  <span class="label label-{{ $role->name == 'admin' ? 'danger' : 'info' }}">{{ $role->display_name }}</span>
                @endforeach
              </td>
              <td class="text-right">
                {{ Form::open(['route' => ['admin.users.destroy', $user->id], 'method' => 'DELETE']) }}
                  <div class="btn-group">
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-success btn-sm">
                      <i class="fa fa-pencil fa-fw"></i>
                    </a>
                    <button type="submit" class="btn btn-danger btn-sm">
                      <i class="fa fa-trash-o fa-fw"></i>
                    </button>
                  </div>
                {{ Form::close() }}
              </td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>

@stop