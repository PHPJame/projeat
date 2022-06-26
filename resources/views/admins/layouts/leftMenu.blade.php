<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-success elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text" style="font-weight: bolder; font-size: 20px; margin-left: 18px; ">Computer
            Education</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-2 pb-2 mb-2 d-flex">
            <div class="info">
                <a href="#" class="d-block" style="font-size: 20px; margin-left: 11px;"><i
                        class="nav-icon bi bi-person-square"></i>
                    &nbsp;
                    ชื่อ :: {{ Auth::user()->name }}
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ url('/admins') }}"
                        class="nav-link <?= Request::segment(1) == 'admins' || Request::segment(1) == '' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>หน้าแรก</p>
                    </a>
                </li>

                <?php if (Auth::user()->id_role == 1) { ?>
                <li class="nav-item">
                    <a href="{{ route('usermanage') }}"
                        class="nav-link <?= Request::segment(1) == 'usermanage' || Request::segment(1) == '' ? 'active' : '' ?>">
                        <i class=" fa fa-user nav-icon"></i>
                        <p>จัดการสมาชิก</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cousesmanage') }}"
                        class="nav-link <?= Request::segment(1) == 'cousesmanage' || Request::segment(1) == '' ? 'active' : '' ?>">
                        <i class="fas fa-book nav-icon"></i>
                        <p>จัดการรายวิชา</p>
                    </a>
                    <?php } ?>

                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link
                    <?= Request::segment(1) == 'topicmanage' || Request::segment(1) == '' ? 'active' : '' ?>
                    <?= Request::segment(1) == 'indexlesson' || Request::segment(1) == '' ? 'active' : '' ?>
                    <?= Request::segment(1) == 'lessonsmanage' || Request::segment(1) == '' ? 'active' : '' ?>">
                        &nbsp; <i class="fas fa-folder"></i>&nbsp;
                        <p>
                            จัดการบทเรียน
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('topicmanage')}}" class="nav-link
                            <?= Request::segment(1) == 'topicmanage' || Request::segment(1) == '' ? 'active' : '' ?>
                            ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>จัดการหัวข้อบทเรียน</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('indexlesson')}}" class="nav-link <?= Request::segment(1) == 'indexlesson' || Request::segment(1) == '' ? 'active' : '' ?>
                                <?= Request::segment(1) == 'lessonsmanage' || Request::segment(1) == '' ? 'active' : '' ?>
                                ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>จัดการบทเรียน</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>จัดการผู้ลงทะเบียน</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>จัดการข้อสอบ</p>
                            </a>
                        </li>
                    </ul>
        </nav>
        <!-- Sidebar Menu -->
    </div>
    <!-- /.sidebar -->
</aside>