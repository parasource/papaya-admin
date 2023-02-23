@extends('layouts.app')

@section('content')

    {{ \Diglactic\Breadcrumbs\Breadcrumbs::render('admin.index') }}

    @include('admin._nav', ['route' => 'home'])

    <div class="row">
        <div class="col">
            <div class="card mx-2 my-2">
                <div class="card-body">
                    <div class="card-title">Образы мужские</div>
                    <div>
                        <canvas id="male-looks-overview-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mx-2 my-2">
                <div class="card-body">
                    <div class="card-title">Образы женские</div>
                    <div>
                        <canvas id="female-looks-overview-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mx-2 my-2">
                <div class="card-body">
                    <div class="card-title">Фильтрация айтемов</div>
                    <div>
                        <canvas id="items-moderation-chart"></canvas>
                    </div>
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
                label: 'Мужские образы',
                data: [{{ $maleLooks['without_items'] }}, {{ $maleLooks['with_not_enough_items'] }}, {{ $maleLooks['with_items'] }}],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 6
            }]
        };

        const maleLooksChart = new Chart(
            document.getElementById('male-looks-overview-chart'),
            {
                type: 'doughnut',
                data: data,
                options: {}
            }
        );

        const femaleData = {
            labels: [
                'Образы без айтемов',
                'Образы с < 4 айтемами',
                'Образы с > 4 айтемами',
            ],
            datasets: [{
                label: 'Женские образы',
                data: [{{ $femaleLooks['without_items'] }}, {{ $femaleLooks['with_not_enough_items'] }}, {{ $femaleLooks['with_items'] }}],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 6
            }]
        };

        const femaleLooksChart = new Chart(
            document.getElementById('female-looks-overview-chart'),
            config = {
                type: 'doughnut',
                data: femaleData,
                options: {}
            }
        );

        const itemsModerationData = {
            labels: [
                'Отфильтрованые айтемы',
                'Неотфильтрованые айтемы',
            ],
            datasets: [{
                label: 'Кол-во айтемов',
                data: [{{ $itemsModeration['yes'] }}, {{ $itemsModeration['no'] }}],
                backgroundColor: [
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 6
            }]
        }

        const itemsModerationChart = new Chart(
            document.getElementById('items-moderation-chart'),
            config = {
                type: 'doughnut',
                data: itemsModerationData,
                options: {}
            }
        );

    </script>
@endsection
