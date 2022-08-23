<div>
    @include('samu.nav')

    <h3 class="mb-2">
        <i class="fas fa-chart-line"></i> Panel de Estadísticas
    </h3>


    <div class="row">
        <div class="col-sm">
            <div class="card">
                <div class="card-header">
                    # de Eventos atendidos en los últimos 30 días
                </div>
                <div class="card-body">
                    <div id="event-last-month" style="width: auto; height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="row mb-2">
        <div class="col-12 col-md-6">
            <div class="card">
                <h6 class="card-header">
                    # de Eventos atendidos por comuna durante el mes de {{ now()->monthName }}
                </h6>
                <div class="card-body pt-2">
                    <div id="event-by-commune" style="width: auto; height: 300px;"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card">
                <h6 class="card-header">
                    # de Eventos atendidos por móviles durante el mes de {{ now()->monthName }}
                </h6>
                <div class="card-body pt-2">
                    <div id="event-by-mobile" style="width: auto; height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-12 col-md-6">
            <div class="card">
                <h6 class="card-header">
                    # de Eventos atendidos agrupados por sexo durante el mes de {{ now()->monthName }}
                </h6>
                <div class="card-body pt-2">
                    <div id="event-by-gender" style="width: auto; height: 300px;"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card">
                <h6 class="card-header">
                    # de Eventos atendidos en los últimos 6 meses
                </h6>
                <div class="card-body pt-2">
                    <div id="event-by-month" style="width: auto; height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col">
            <div class="card">
                <h6 class="card-header">
                    # de Eventos por Tipo de Móvil
                </h6>
                <div class="card-body pt-2">
                    @livewire('samu.dashboard.event-by-mobile-type')
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @livewire('samu.stadistic')
    </div>
</div>

@section('custom_js')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script>
        google.charts.load('current', {'packages':['corechart']});

        console.log("afuera");

        document.addEventListener('livewire:load', () => {
            google.charts.setOnLoadCallback(eventLastMonth)
            google.charts.setOnLoadCallback(eventByCommune)
            google.charts.setOnLoadCallback(eventByMobile)
            google.charts.setOnLoadCallback(eventByMonth)
            google.charts.setOnLoadCallback(eventByGender)
        })

        function eventLastMonth() {
            google.charts.load('current', {'packages':['corechart']});
            var data = google.visualization.arrayToDataTable(@this.event_last_month);
            var options = {
                legend: { position: "none" },
                hAxis: {
                    title: 'Día',
                },
                vAxis: {
                    title: '# eventos atendidos',
                }
            };
            var chart = new google.visualization.ColumnChart(document.getElementById('event-last-month'));
            chart.draw(data, options);
        }

        function eventByCommune() {
            google.charts.load('current', {'packages':['corechart']});
            var data = google.visualization.arrayToDataTable(@this.event_by_commune);
            var options = {
                legend: { position: "none" },
                hAxis: {
                    title: 'Comuna',
                },
                vAxis: {
                    title: '# de eventos',
                }
            };
            var chart = new google.visualization.ColumnChart(document.getElementById('event-by-commune'));
            chart.draw(data, options);
        }

        function eventByMobile() {
            google.charts.load('current', {'packages':['corechart']});
            var data = google.visualization.arrayToDataTable(@this.event_by_mobile);
            var options = {
                legend: { position: "none" },
                hAxis: {
                    title: 'Móviles',
                },
                vAxis: {
                    title: '# de eventos',
                }
            };
            var chart = new google.visualization.ColumnChart(document.getElementById('event-by-mobile'));
            chart.draw(data, options);
        }

        function eventByMonth() {
            google.charts.load('current', {'packages':['corechart']});
            var data = google.visualization.arrayToDataTable(@this.event_by_month);
            var options = {
                legend: { position: "none" },
                hAxis: {
                    title: 'Mes',
                },
                vAxis: {
                    title: '# de eventos',
                }
            };
            var chart = new google.visualization.ColumnChart(document.getElementById('event-by-month'));
            chart.draw(data, options);
        }

        function eventByGender() {
            google.charts.load('current', {'packages':['corechart']});
            var data = google.visualization.arrayToDataTable(@this.event_by_gender);
            var options = {
                is3D: true,
                slices: {
                    0: { color: '#006cb7' },
                    1: { color: '#c90076' },
                    2: { color: '#491152' },
                    3: { color: '#8fce00' },
                    4: { color: '#5b5b5b' },
                    5: { color: '#c90076' },
                }
            }
            var chart = new google.visualization.PieChart(document.getElementById('event-by-gender'));
            chart.draw(data, options);
        }
      </script>
@endsection
