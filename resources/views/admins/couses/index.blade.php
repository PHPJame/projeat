@extends('admins.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('admins')}}">หน้าแรก</a></li>
                    <li class="breadcrumb-item active">จัดการรายวิชา</li>
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
                    <div class="bi bi-table"> จัดการรายวิชา
                        <div style="float:right;">
                            <?= link_to('cousesmanage/create', $title = ' เพิ่มรายวิชา', ['class' => 'btn btn-success bi bi-plus-circle'], $secure = null) ?>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-2">
                    <table class="table table-bordered table-striped w-100 text-center " id="example1">
                        <br>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>รายวิชา</th>
                                <th>แก้ไข</th>
                                <th>ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($couses as $couses1)
                            <?php $i++; ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td>{{ $couses1->couses_name }}</td>
                                <td>
                                    <?= link_to('cousesmanage/' . $couses1->id . '/edit', ' แก้ไข', ['class' => 'btn btn-warning text-light bi bi-pencil'], $secure = null) ?>
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
                                                    ต้องการลบข้อมูล {{ $couses1->name }} ใช่หรือไหม
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">ยกเลิก</button>
                                                    <?= Form::open(['url' => 'cousesmanage/' . $couses1->id, 'method' => 'delete']) ?>
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
@if (session()->has('faile'))
<script>
swal("<?php echo session()->get('faile'); ?>", "", "error");
</script>
@endif
@if (session()->has('add'))
<script>
swal("<?php echo session()->get('add'); ?>", "", "success");
</script>
@endif
@if (session()->has('delete'))
<script>
swal("<?php echo session()->get('delete'); ?>", "", "success");
</script>
@endif
@endsection