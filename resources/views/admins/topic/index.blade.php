@extends('admins.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('admins')}}">หน้าแรก</a></li>
                    <li class="breadcrumb-item active">จัดการหัวข้อบทเรียน</li>
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
                    <div class="bi bi-table"> จัดการหัวข้อบทเรียน
                        <div style="float:right;">
                            <?= link_to('topicmanage/create', $title = ' เพิ่มหัวข้อบทเรียน', ['class' => 'btn btn-success bi bi-plus-circle'], $secure = null) ?>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-2">
                    <table class="table table-bordered table-striped w-100 text-center " id="example1">
                        <br>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>หัวข้อบทเรียน</th>
                                <th>รายวิชา</th>
                                <th>ผู้สร้าง</th>
                                <th>สถานะ</th>
                                <th>แก้ไข</th>
                                <th>ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($topic as $topic1)
                            <?php $i++; ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td>{{ $topic1->topic_name }}</td>
                                <td>{{ $topic1->couses->couses_name}}</td>
                                <td>@foreach ($userProfile as $user)
                                    <?php
                                    if ($user->id == $topic1->id_users) {
                                        echo $user->name;
                                    }
                                    ?>
                                    @endforeach</td>
                                <td> <?php if ($topic1->publish == 0) echo '<i class="fas fa-circle" style="color:red"></i> ยังไม่เผยแพร่'; ?>
                                    <?php if ($topic1->publish == 1) echo '<i class="fas fa-circle" style="color:green"></i> เผยแพร่แล้ว'; ?>
                                </td>
                                <td>
                                    <?= link_to('topicmanage/' . $topic1->id . '/edit', ' แก้ไข', ['class' => 'btn btn-warning text-light bi bi-pencil'], $secure = null) ?>
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
                                                    ต้องการลบข้อมูล {{ $topic1->name }} ใช่หรือไหม
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">ยกเลิก</button>
                                                    <?= Form::open(['url' => 'topicmanage/' . $topic1->id, 'method' => 'delete']) ?>
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