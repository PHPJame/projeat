@extends('admins.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('admins/') }}">หน้าแรก</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('indexlesson/') }}">จัดการบทเรียน</a></li>
                    <li class="breadcrumb-item active">{{$cname->topic_name}}</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

{{-- Main Content --}}
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-12">
                        <div class="modal fade" id="creatlessons" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">เพิ่มบทเรียน
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-left">
                                        <?= Form::open(['url' => 'lessonsmanage/', 'files' => false]) ?>
                                        <div class="form-group">
                                            <?= Form::label('lesson_sort', 'ลำดับบทเรียน') ?>
                                            <?= Form::number('lesson_sort', null, ['class' => 'form-control', 'placeholder' => 'ลำดับบทเรียน', 'required']) ?>
                                        </div>
                                        <div class="form-group">
                                            <?= Form::label('lesson_name', 'ชื่อบทเรียน') ?>
                                            <?= Form::text('lesson_name', null, ['class' => 'form-control', 'placeholder' => 'ชื่อบทเรียน', 'rows' => '5', 'required']) ?>
                                        </div>
                                        <input type="hidden" id="id_topic" name="id_topic" value="{{$id}}">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger"
                                            data-dismiss="modal">ยกเลิก</button>
                                        <button type="submit" class="btn btn-primary">บันทึก</button>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-header h4 ">
                                <div class="bi bi-table"> จัดการบทเรียน
                                    <div style="float:right;">
                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                            data-target="#creatlessons"><i class="bi bi-plus-circle"></i>
                                            เพิ่มบทเรียน</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-2">
                                <table class="table table-bordered table-striped w-100 text-center" id="example1">
                                    <thead>
                                        <tr>
                                            <th>ลำดับบทเรียน</th>
                                            <th>ชื่อบทเรียน</th>
                                            <th>แก้ไขเนื้อหา</th>
                                            <th>แก้ไข</th>
                                            <th>ลบ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; ?>
                                        @foreach ($lessons as $les)
                                        <?php $i++; ?>
                                        <tr>
                                            <td>{{ $les->lesson_sort }}</td>
                                            <td>{{ $les->lesson_name }}</td>
                                            <td><a name="" id="" class="btn btn-success"
                                                    href="{{url('/lessonsfilevideo/'.$les->id.'/edit')}}"
                                                    role="button"><i class="fas fa-edit"></i> จัดการเนื้อหา</a>
                                            </td>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-warning text-light"
                                                    data-toggle="modal" data-target="#editlesson<?= $i ?>"><i
                                                        class="bi bi-pencil"></i>
                                                    แก้ไข</button>
                                                <div class="modal fade" id="editlesson<?= $i ?>" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    แก้ไขบทเรียน
                                                                    {{ $les->lesson_name }}
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body text-left">
                                                                <?= Form::model($les, ['url' => 'lessonsmanage/' . $les->id, 'method' => 'put', 'files' => false]) ?>
                                                                <div class="form-group">
                                                                    <?= Form::label('lesson_sort', 'ลำดับบทเรียน') ?>
                                                                    <?= Form::number('lesson_sort', null, ['class' => 'form-control', 'placeholder' => 'ลำดับบทเรียน', 'required']) ?>
                                                                </div>
                                                                <div class="form-group">
                                                                    <?= Form::label('lesson_name', 'ชื่อบทเรียน') ?>
                                                                    <?= Form::text('lesson_name', null, ['class' => 'form-control', 'placeholder' => 'ชื่อบทเรียน', 'rows' => '5', 'required']) ?>
                                                                </div>
                                                                <input type="hidden" id="id_topic" name="id_topic"
                                                                    value="{{$id}}">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger"
                                                                    data-dismiss="modal">ยกเลิก</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">บันทึก</button>
                                                            </div>
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#exampleModal<?= $i ?>">
                                                    ลบ
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal<?= $i ?>" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    แจ้งเตือน</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                ต้องการลบข้อมูล
                                                                {{ $les->lesson_name }} ใช่หรือไหม
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">ยกเลิก</button>
                                                                <?= Form::open(['url' => 'lessonsmanage/' . $les->id, 'method' => 'delete']) ?>
                                                                <input type="hidden" id="id_topic" name="id_topic"
                                                                    value="{{$id}}">
                                                                <button type="submit"
                                                                    class="btn btn-danger">ตกลง</button>
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
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <!-- /.card -->
                    </div>
                </div>
            </div>
            <div class="col-sm-2"></div>
        </div>
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