@extends('layouts.adminlayout.admin_design')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Departments</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('view.department')}}">Departments</a></li>
              <li class="breadcrumb-item active">View</li>
            </ol>
          </div>
        </div>
        @if(Session::has('flash_message_error'))
          <div class="alert alert-danger alert-block errorAlert" id="autoClose" >
            <button type="button" class="close" data-dismiss="alert">×</button>
             <em class="text-warning" id="message">{!!session('flash_message_error')!!}</em>
            </div>
            @endif
            @if(Session::has('flash_message_success'))
            <div class="alert alert-success alert-block successAlert" id="autoClose" >
              <button type="button" class="close" data-dismiss="alert">×</button>
              <em class="text-primary" id="message">{!!session('flash_message_success')!!}</em>
            </div>
            @endif
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <!-- /.card -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"><a class=" btn btn-success" href="{{route('add.department')}}">Add New </a></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach($departments as $department)
              <tr>
                <td>{{ $department->id}}</td>
                <td>{{ $department->name}}</td>
                <td>{{ $department->description}}</td>
                <td>{{ $department->status}}</td>
                <td> <button data-toggle="modal" data-target="#departmentModal{{ $department->id }}" class="btn btn-primary btn-sm">View <i class="fa fa-eye"></i></button> |
                     <a href="{{url('department/edit/'.$department->id)}}" class="btn btn-warning btn-sm">Edit <i class="fa fa-edit"></i></a> |
                     <a rel="{{$department->id}}" rel1="delete" href="javascript:" class="btn btn-danger btn-sm deleteDepartment">Delete <i class="fa fa-trash"></i></a></td>
              </tr>
              <div class="modal fade" id="departmentModal{{ $department->id }}">
                               <div class="modal-dialog">
                                   <div class="modal-content bg-primary">
                                       <div class="modal-header">
                                           <h4 class="modal-title">Name: {{ $department->name}}</h4>
                                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                               <span aria-hidden="true">&times;</span></button>
                                       </div>
                                       <div class="modal-body">
                                           <p class="text-center">Description: {{ $department->description}}</p>
                                           <p class="text-center">Status: {{ $department->status}}</p>
                                           <p class="text-center">Created on: {{$department->created_at}}</p>
                                           <p class="text-center">Updated on: {{$department->updated_at}}</p>
                                       </div>
                                       <div class="modal-footer justify-content-between">
                                           <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                       </div>
                                   </div>
                                   <!-- /.modal-content -->
                               </div>
                               <!-- /.modal-dialog -->
                           </div>
                           <!-- /.modal -->
                           @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
