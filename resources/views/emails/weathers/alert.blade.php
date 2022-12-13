


@if ($weather->getPrecipitation() > 0)
    <img src="https://w7.pngwing.com/pngs/49/967/png-transparent-rain-rain-blue-cloud-drop-thumbnail.png" class="w-full">
@endif

@if ($weather->getPrecipitation() == 0)
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRsIfCOR6F9eJDoFJXi3hXO1nF5zjnwB8TOZQ&usqp=CAU" class="w-full">  
@endif
<h1>{{ $city->getName() }}, {{ $weather->getTemperature() }}*C</h1>

<p>Precipitation: {{ $weather->getPrecipitation() }} m^3</p>
<p>Wind Speed: {{ $weather->getWindSpeed() }} m/s</p>
<p>Pressure: {{ $weather->getPressure() }} hPa</p>


<h1> {{ $weather->getMassage()}}</h1>