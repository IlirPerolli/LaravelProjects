@extends('layouts.admin')
@section('content')
    <h1> Admin </h1>
    <canvas id="myChart"></canvas>

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: ['Posts', 'Categories', 'Comments'],
            datasets: [{
                label: 'CMS data',
                backgroundColor: 'rgb(255,99,132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [{{$postsCount}}, {{$categoriesCount}},{{$commentsCount}}]
            }]
        },

        // Configuration options go here
        options: {}
    });
</script>
@endsection
