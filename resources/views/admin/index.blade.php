@extends('layouts.app')

@section('content')

    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('admin.index') }}

    @include('admin._nav', ['route' => 'home'])

    <div class="row">
        <div class="col">
            <div class="card mx-2 my-2">
                <div class="card-body">
                    <div class="card-title">Сводка по образам</div>
                    <div>
                        <canvas id="looks-overview-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mx-2 my-2">
                <div class="card-body">
                    <div class="card-title">Сводка по гардеробу</div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mx-2 my-2">
                <div class="card-body">
                    <div class="card-title">Всего образов добавлено</div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>

        const data = {
            labels: [
                'Образы без айтемов',
                'Образы с < 4 айтемами',
                'Образы с > 4 айтемами',
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [{{ $looksWithoutItems }}, {{ $looksWithNotEnoughItems }}, {{ $looksWithItems }}],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 6
            }]
        };

        const config = {
            type: 'doughnut',
            data: data,
            options: {}
        };

        const myChart = new Chart(
            document.getElementById('looks-overview-chart'),
            config
        );

    </script>
@endsection
