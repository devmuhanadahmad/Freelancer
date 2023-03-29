<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="{{route("dashboard")}}">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{__("Dashboard")}}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>

                    </li>
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{__("Components")}} </li>

                   <x-slider />>
                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
