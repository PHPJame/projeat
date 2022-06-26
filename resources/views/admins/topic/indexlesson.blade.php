@extends('admins.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('admins')}}">หน้าแรก</a></li>
                    <li class="breadcrumb-item active">จัดการบทเรียน</li>
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
                    <div class="bi bi-table"> จัดการบทเรียน
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
                                <th>จัดการบทเรียน</th>
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
                                    <a class="btn btn-success" href="lessonsmanage/<?= $topic1->id ?>/edit"><i
                                            class="fas fa-edit"></i> จัดการบทเรียน</a>
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
@endsection