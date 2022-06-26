@extends('admins.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admins')}}">หน้าแรก</a></li>
                    <li class="breadcrumb-item active">แก้ไขหัวข้อบทเรียน</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8 col-log-offset-1">
            <div class="card mt-3">
                <div class="card-header h4">
                    แก้ไขหัวข้อบทเรียน
                </div>
                <div class="card-body">
                    <?= Form::model($topic, ['url' => 'topicmanage/' . $topic->id, 'method' => 'put', 'files' => true]) ?>
                    <div class="form-group">
                        <?= Form::label('topic_name', 'ชื่อหัวข้อบทเรียน') ?>
                        <?= Form::text('topic_name', null, ['class' => 'form-control', 'placeholder' => 'ชื่อรายวิชา']) ?>
                    </div>
                    <div class="form-group">
                        {!! Form::label('couses_id', 'รายวิชา') !!}
                        <?= Form::select('couses_id', App\Couses::all()->pluck('couses_name', 'id'), null, ['class' => 'form-control', 'placeholder' => 'เลือกรายวิชา', 'required']) ?>
                    </div>
                    <div class="form-group">
                        <?= Form::label('topic_detail', 'รายละเอียด') ?>
                        <?= Form::textarea('topic_detail', null, ['class' => 'form-control', 'placeholder' => 'รายละเอียด', 'rows' => '5', 'required']) ?>
                    </div>
                    <?php
                    $c1 = '';
                    $c2 = '';
                    if ($topic->publish == 0) {
                        $c1 = 'checked';
                    }
                    if ($topic->publish == 1) {
                        $c2 = 'checked';
                    }
                    ?>
                    <div class="form-group">
                        <label for="publish">สถานะ</label>
                        <div class="col-md-6 mt-2">
                            <input type="radio" id="publish_0" name="publish" value="0" <?= $c1 ?>>
                            <label for="html"> &nbsp;ไม่เผยแพร่</label>&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" id="publish_1" name="publish" value="1" <?= $c2 ?>>
                            <label for="html"> &nbsp;เผยแพร่</label>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('topic_images', 'แก้ไขรูปภาพ') !!}
                        <?= Form::file('topic_images', null, ['class' => 'form-control']) ?>
                    </div>
                    <div class="form-group">
                        <?= Form::label('topic_videos', 'Link วิดีโอแนะนำ') ?>
                        <?= Form::text('topic_videos', null, ['class' => 'form-control', 'placeholder' => 'วิดีโอแนะนำ', 'required']) ?>
                    </div>
                    <div class=" form-group">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            บันทึก
                        </button>
                        <a class="btn btn-danger" href="{{ route('topicmanage') }}" role="button">ยกเลิก</a>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">แจ้งเตือน</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    ต้องการบันทึกการแก้ไขข้อมูลใช่หรือไหม
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                    <?= Form::submit('ตกลง', ['class' => 'btn btn-warning text-light ']) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>
</div>
@endsection