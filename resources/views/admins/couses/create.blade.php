@extends('admins.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('admins/')}}">หน้าแรก</a></li>
                    <li class="breadcrumb-item active">เพิ่มรายวิชา</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="container-fluid">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="card mt-3">
                <div class="card-header h4">
                    เพิ่มรายวิชา
                </div>

                <div class="card-body">
                    <?= Form::open(['url' => 'cousesmanage/', 'files' => true]) ?>
                    <div class="form-group">
                        <?= Form::label('couses_name', 'ชื่อรายวิชา') ?>
                        <?= Form::text('couses_name', null, ['class' => 'form-control', 'placeholder' => 'ชื่อรายวิชา', 'required']) ?>
                    </div>

                    <div class="form-group">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            บันทึก
                        </button>
                        <a class="btn btn-danger" href="{{ route('cousesmanage') }}" role="button">ยกเลิก</a>
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
                                    ต้องการบันทึกข้อมูลใช่หรือไหม
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                    <?= Form::submit('ตกลง', ['class' => 'btn btn-success ']) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-2"></div>
    </div>
</div>
@endsection