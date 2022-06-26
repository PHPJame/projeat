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
                    <li class="breadcrumb-item"><a
                            href="{{ url('lessonsmanage/' . $topicName->id . '/edit') }}">{{ $topicName->topic_name }}</a>
                    </li>
                    <li class="breadcrumb-item active">จัดการเนื้อหา</li>
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
                                        <h5 class="modal-title" id="exampleModalLabel">เพิ่มวิดีโอ
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-left">
                                        <?= Form::open(['url' => 'lessonsfilevideo/', 'files' => false]) ?>
                                        <div class="form-group">
                                            <?= Form::label('video_name', 'ชื่อวิดีโอ') ?>
                                            <?= Form::text('video_name', null, ['class' => 'form-control', 'placeholder' => 'ชื่อวิดีโอ', 'required']) ?>
                                        </div>
                                        <div class="form-group">
                                            <?= Form::label('video_path', 'ลิ้งวิดีโอ') ?>
                                            <?= Form::text('video_path', null, ['class' => 'form-control', 'placeholder' => 'ลิ้งวิดีโอ', 'required']) ?>
                                        </div>
                                        <input type="hidden" id="Video_Type" name="Video_Type" value="Video_Type">
                                        <input type="hidden" id="Video_id_topic" name="Video_id_topic"
                                            value="{{ $topicName->id }}">
                                        <input type="hidden" id="Video_lesson_id" name="Video_lesson_id"
                                            value="{{ $lessonName->id }}">
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
                                <div class="bi bi-table"> จัดการวิดีโอ
                                    <div style="float:right;">
                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                            data-target="#creatlessons"><i class="bi bi-plus-circle"></i>
                                            เพิ่มวิดีโอ</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-2">
                                <table class="table table-bordered table-striped w-100 text-center" id="example1">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ชื่อวิดีโอ</th>
                                            <th>ลิ้งวิดีโอ</th>
                                            <th>แก้ไข</th>
                                            <th>ลบ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; ?>
                                        @foreach ($lessonVideo as $lesVideo)
                                        <?php $i++; ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td>{{ $lesVideo->video_name }}</td>
                                            <td>{{ $lesVideo->video_path }}</td>
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
                                                                    แก้ไขวิดีโอ
                                                                    {{ $lesVideo->video_name }}
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body text-left">
                                                                <?= Form::model($lesVideo, ['url' => 'lessonsfilevideo/' . $lesVideo->id, 'method' => 'put', 'files' => false]) ?>
                                                                <div class="form-group">
                                                                    <?= Form::label('video_name', 'ชื่อวิดีโอ') ?>
                                                                    <?= Form::text('video_name', null, ['class' => 'form-control', 'placeholder' => 'ชื่อวิดีโอ', 'required']) ?>
                                                                </div>
                                                                <div class="form-group">
                                                                    <?= Form::label('video_path', 'ลิ้งวิดีโอ') ?>
                                                                    <?= Form::text('video_path', null, ['class' => 'form-control', 'placeholder' => 'ลิ้งวิดีโอ', 'required']) ?>
                                                                </div>
                                                                <input type="hidden" id="Video_Type" name="Video_Type"
                                                                    value="Video_Type">
                                                                <input type="hidden" id="Video_id_topic"
                                                                    name="Video_id_topic" value="{{ $topicName->id }}">
                                                                <input type="hidden" id="Video_lesson_id"
                                                                    name="Video_lesson_id"
                                                                    value="{{ $lessonName->id }}">
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
                                                                {{ $lesVideo->lesson_name }} ใช่หรือไหม
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">ยกเลิก</button>
                                                                <?= Form::open(['url' => 'lessonsfilevideo/' . $lesVideo->id, 'method' => 'delete']) ?>
                                                                <input type="hidden" id="delete_Video"
                                                                    name="delete_Video" value="delete_Video">
                                                                <input type="hidden" id="Video_lesson_id"
                                                                    name="Video_lesson_id"
                                                                    value="{{ $lessonName->id }}">
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
                        <hr>
                        <div class="modal fade" id="lessonsVideo" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">เพิ่มไฟล์
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-left">
                                        <?= Form::open(['url' => 'lessonsfilevideo/', 'files' => true]) ?>
                                        <div class="form-group">
                                            <?= Form::label('files_name', 'ชื่อไฟล์') ?>
                                            <?= Form::text('files_name', null, ['class' => 'form-control', 'placeholder' => 'ชื่อไฟล์', 'required']) ?>
                                        </div>
                                        <div class="form-group">
                                            <?= Form::label('files_path', 'อัพโหลดไฟล์') ?>
                                            <?= Form::file('files_path', null, ['class' => 'form-control', 'required']) ?>
                                        </div>
                                        <input type="hidden" id="File_Type" name="File_Type" value="File_Type">
                                        <input type="hidden" id="File_id_topic" name="File_id_topic"
                                            value="{{ $topicName->id }}">
                                        <input type="hidden" id="File_lesson_id" name="File_lesson_id"
                                            value="{{ $lessonName->id }}">
                                        <input type="hidden" id="topic_name" name="topic_name"
                                            value="{{ $topicName->topic_name }}">
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
                                <div class="bi bi-table"> จัดการไฟล์
                                    <div style="float:right;">
                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                            data-target="#lessonsVideo"><i class="bi bi-plus-circle"></i>
                                            เพิ่มไฟล์</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-2">
                                <table id="example3" class="table table-bordered table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ชื่อไฟล์</th>
                                            <th>ไฟล์</th>
                                            <th>แก้ไข</th>
                                            <th>ลบ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; ?>
                                        @foreach ($lessonFile as $lesFile)
                                        <?php $i++; ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td>{{ $lesFile->files_name }}</td>
                                            <td>
                                                <a href="{{ url('/storage/' . $topicName->topic_name . '/' . $lesFile->files_path) }}"
                                                    target="_blank">{{ $lesFile->files_path }}</a>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-warning text-light"
                                                    data-toggle="modal" data-target="#editlessonFile<?= $i ?>"><i
                                                        class="bi bi-pencil"></i>
                                                    แก้ไข</button>
                                                <div class="modal fade" id="editlessonFile<?= $i ?>" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    แก้ไขไฟล์
                                                                    {{ $lesFile->files_name }}
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body text-left">
                                                                <?= Form::model($lesFile, ['url' => 'lessonsfilevideo/' . $lesFile->id, 'method' => 'put', 'files' => true]) ?>
                                                                <?= Form::open(['url' => 'lessonsfilevideo/', 'files' => true]) ?>
                                                                <div class="form-group">
                                                                    <?= Form::label('files_name', 'ชื่อไฟล์') ?>
                                                                    <?= Form::text('files_name', null, ['class' => 'form-control', 'placeholder' => 'ชื่อไฟล์', 'required']) ?>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>ไฟล์เดิม</label>
                                                                    <a href="{{ url('/storage/' . $topicName->topic_name . '/' . $lesFile->files_path) }}"
                                                                        target="_blank">{{ $lesFile->files_path }}</a>
                                                                </div>
                                                                <div class="form-group">
                                                                    <?= Form::label('files_path', 'อัพโหลดไฟล์') ?>
                                                                    <?= Form::file('files_path', null, ['class' => 'form-control']) ?>
                                                                </div>
                                                                <input type="hidden" id="File_Type" name="File_Type"
                                                                    value="File_Type">
                                                                <input type="hidden" id="File_id_course"
                                                                    name="File_id_topic value=" {{ $topicName->id }}">
                                                                <input type="hidden" id="File_lesson_id"
                                                                    name="File_lesson_id" value="{{ $lessonName->id }}">
                                                                <input type="hidden" id="topic_name" name="topic_name"
                                                                    value="{{ $topicName->topic_name }}">
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
                                                    data-target="#deleteFile<?= $i ?>">
                                                    ลบ
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="deleteFile<?= $i ?>" tabindex="-1"
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
                                                                ต้องการลบไฟล์ <i class="fas fa-arrow-right"></i>
                                                                {{ $lesFile->files_name }}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">ยกเลิก</button>
                                                                <?= Form::open(['url' => 'lessonsfilevideo/' . $lesFile->id, 'method' => 'delete']) ?>
                                                                <input type="hidden" id="delete_File" name="delete_File"
                                                                    value="delete_File">
                                                                <input type="hidden" id="File_lesson_id"
                                                                    name="File_lesson_id" value="{{ $lessonName->id }}">
                                                                <input type="hidden" id="topic_name" name="topic_name"
                                                                    value="{{ $topicName->topic_name }}">
                                                                <button type="submit" class="btn btn-danger">ลบ</button>
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