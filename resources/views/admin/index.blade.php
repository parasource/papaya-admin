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
                    <div class="card-title">Топ образов по количеству лайков</div>
                    <div class="card-body">
                        @foreach($topLooks as $look)
                            <div class="row bg-light p-2 mt-2 border-dark border-1">
                                <div class=""
                                     style="width: 50px; height: 75px; background-image: url('https://static.papaya.parasource.tech{{ $look->image_resized }}'); background-size: cover"></div>
                                <div class="col">
                                    <a href="{{ route('admin.looks.show', $look) }}">{{ $look->name }}</a>
                                </div>
                                <div class="col">
                                    {{ $look->likes_count }}
                                </div>
                            </div>
                        @endforeach
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

    </script>
@endsection
