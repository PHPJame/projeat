@extends('layouts.app')
@section('style')
<style>
.control {
    font-family: arial;
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 15px;
    padding-top: 0px;
    cursor: pointer;
    font-size: 16px;
}

.control input {
    position: absolute;
    z-index: -1;
    opacity: 0;
}

.control_indicator {
    position: absolute;
    top: 2px;
    left: 0;
    height: 20px;
    width: 20px;
    background: #e6e6e6;
    border: 0px solid #000000;
    border-radius: undefinedpx;
}

.control:hover input~.control_indicator,
.control input:focus~.control_indicator {
    background: #cccccc;
}

.control input:checked~.control_indicator {
    background: #2aa1c0;
}

.control:hover input:not([disabled]):checked~.control_indicator,
.control input:checked:focus~.control_indicator {
    background: #0e6647d;
}

.control input:disabled~.control_indicator {
    background: #e6e6e6;
    opacity: 0.6;
    pointer-events: none;
}

.control_indicator:after {
    box-sizing: unset;
    content: '';
    position: absolute;
    display: none;
}

.control input:checked~.control_indicator:after {
    display: block;
}

.control-radio .control_indicator {
    border-radius: 50%;
}

.control-radio .control_indicator:after {
    left: 7px;
    top: 7px;
    height: 6px;
    width: 6px;
    border-radius: 50%;
    background: #ffffff;
    transition: background 250ms;
}

.control-radio input:disabled~.control_indicator:after {
    background: #7b7b7b;
}

.control-radio .control_indicator::before {
    content: '';
    display: block;
    position: absolute;
    left: 0;
    top: 0;
    width: 4.5rem;
    height: 4.5rem;
    margin-left: -1.3rem;
    margin-top: -1.3rem;
    background: #2aa1c0;
    border-radius: 3rem;
    opacity: 0.6;
    z-index: 99999;
    transform: scale(0);
}

@keyframes s-ripple {
    0% {
        opacity: 0;
        transform: scale(0);
    }

    20% {
        transform: scale(1);
    }

    100% {
        opacity: 0.01;
        transform: scale(1);
    }
}

@keyframes s-ripple-dup {
    0% {
        transform: scale(0);
    }

    30% {
        transform: scale(1);
    }

    60% {
        transform: scale(1);
    }

    100% {
        opacity: 0;
        transform: scale(1);
    }
}

.control-radio input+.control_indicator::before {
    animation: s-ripple 250ms ease-out;
}

.control-radio input:checked+.control_indicator::before {
    animation-name: s-ripple-dup;
}
</style>
@endsection
@section('content')
<div class="container" style="margin-bottom:20%">
    {{-- <h4><a href="{{url('/')}}" class="stretched-link text-orange">Home </a>/ <?= $topics_page->topic_name ?></h4>
    --}}
    <div class="row">
        <div class="card mb-3 col-lg-12 shadow-sm" style="margin-top: 100px;">
            <div class="row g-0">
                <div class="col-md-8">
                    <iframe width="100%" height="400" src="<?= $topics_page->topic_videos ?>"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>
                <div class="col-md-4">
                    <div class="card-body">
                        <h3 class="card-title"><?= $topics_page->topic_name ?></h3>
                        <h5 class="card-title">รายวิชา : <?= $couses_page_type->couses_name ?></h5>
                        <h5 class="card-title">รายละเอียด :
                            <?= $topics_page->topic_detail ?></h5>
                        <br><button type="submit" class="btn text-white w-100"
                            style="background-color:#F77100">ลงทะเบียน</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>