@extends('admins.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('admins')}}">หน้าแรก</a></li>
                    <li class="breadcrumb-item active">จัดการข้อมูลสมาชิก</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="container-fluid">
    <div class="row">
        <div class="col-1"></div>
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-header h4 ">
                    <div class="bi bi-table"> จัดการข้อมูลสมาชิก
                        <div style="float:right;">
                            <?= link_to('usermanage/create', $title = ' เพิ่มสมาชิก', ['class' => 'btn btn-success bi bi-plus-circle'], $secure = null) ?>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered table-striped w-100 text-center" id="example1">
                        <br>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>รหัสสมาชิก</th>
                                <th>ชื่อ</th>
                                <th>อีเมล</th>
                                <th>สถานะ</th>
                                <th>แก้ไข</th>
                                <th>ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($users as $user)
                            <?php $i++; ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    {{ $user->profile->role_name }}
                                </td>
                                <td>
                                    <?= link_to('usermanage/' . $user->id . '/edit', ' แก้ไข', ['class' => 'btn btn-warning text-light bi bi-pencil'], $secure = null) ?>
                                </td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger bi bi-trash" data-toggle="modal"
                                        data-target="#exampleModal<?= $i ?>">
                                        ลบ
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal<?= $i ?>" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">แจ้งเตือน</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    ต้องการลบข้อมูล {{ $user->name }} ใช่หรือไหม
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">ยกเลิก</button>
                                                    <?= Form::open(['url' => 'usermanage/' . $user->id, 'method' => 'delete']) ?>
                                                    <button type="submit" class="btn btn-danger">ตกลง</button>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>

                </div>
            </div>
        </div>
        <div class="col-1"></div>
    </div>

</div>
@endsection
@section('footer')
@if (session()->has('status'))
<script>
swal("<?php echo session()->get('status'); ?>", "", "success");
</script>
@endif
@endsection