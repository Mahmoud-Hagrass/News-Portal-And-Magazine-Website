<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
        </a>
    </div>

    <!-- Content Row -->
    <div class="row">
        @livewire('backend.admin.dashboard-statistic')
    </div>

    <!-- Charts Row -->
    <div class="row">
        <!-- Users Chart -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Users Chart</h6>
                </div>
                <div class="card-body">
                    <h1 class="h5 mb-4">{{ $chart1->options['chart_title'] }}</h1>
                    {!! $chart1->renderHtml() !!}
                </div>
            </div>
        </div>

        <!-- Posts Chart -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Posts Chart</h6>
                </div>
                <div class="card-body">
                    <h1 class="h5 mb-4">{{ $chart2->options['chart_title'] }}</h1>
                    {!! $chart2->renderHtml() !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        @livewire('backend.admin.post-comments')
    </div>
</div>

@push('js')
    {!! $chart1->renderChartJsLibrary() !!}
    {!! $chart1->renderJs() !!}
    {!! $chart2->renderChartJsLibrary() !!} <!-- Ensure the JS library for chart2 is included -->
    {!! $chart2->renderJs() !!}
@endpush