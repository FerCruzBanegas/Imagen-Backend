<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Factura</title>
  <style>
    * {
      margin: auto;
      font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }

    @media print {
      .new-page {
        page-break-before: always;
      }
    }
    
    .container{width:100%; margin-bottom: 35px;}
    .left{float:left;width:300px; font-weight:bold; font-size: 25px; border:2px solid black; margin-left:100px; padding:7px;}
    .right{float:right;width:500px; border:2px solid black; margin-right:80px;  margin-top: -90px; padding:7px;}
    .center{margin:0 auto; width:700px; font-weight:bold; font-size: 25px; margin-top: -90px; text-align: justify;
    text-align-last: center;}

    .data-user span {
      display: block;
      padding: 5px;
      white-space: pre;
      font-size:   10pt;
      line-height: 12pt;
    }

    .styled-table {
      border-collapse: collapse;
      margin: 25px 0;
      font-size: 1.5em;
      font-family: sans-serif;
      /* min-width: 400px; */
      width: 100%;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }

    .styled-table thead tr {
      background-color: #9e0207;
      color: #ffffff;
      text-align: left;
    }

    .styled-table th,
    .styled-table td {
      padding: 12px 15px;
    }

    .styled-table tbody tr {
      border-bottom: 1px solid #dddddd;
    }

    .styled-table tbody tr:nth-of-type(even) {
      background-color: #f3f3f3;
    }

    .styled-table tbody tr:last-of-type {
      border-bottom: 2px solid #9e0207;
    }       

    .styled-table tbody tr.active-row {
      font-weight: bold;
      /* color: #009879; */
    }

    .detail {
      font-size: 1.5em;
      height: 200px;
      width: 50%;
      background-color: #f3f3f3;
      float:left;
    }

    .detail div {
      margin: 4px;
    }

    .detail div a {
      color: #9e0207;
      font-weight: bold;
    }

    .qr {
      height: 200px;
      width: 50%;
      /* background-color: powderblue; */
      float:right;
    }
  </style>
</head>
<body>
  @foreach($billboards as $billboard)
    <div class="new-page">
      <img src="{{url('/img/head.png')}}" />
      <div class="container">
        <div class="left">CÓDIGO: <span style="display:inline-block; float: right;">{{ $billboard['code'] }}</span></div>
          <div class="right">
            <p class="data-user" style="color: #0000;">
              <span style="font-size: 22px; font-weight: bold;">CONTACTOS:</span>
              <span style="font-size: 18px; font-weight: bold;">{{ $billboard['user']['forename'] }} {{ $billboard['user']['surname'] }}</span>
              <span style="font-size: 18px; font-weight: bold;">Telf.: {{ $billboard['user']['phone'] }}</span>
              <span style="font-size: 18px; font-weight: bold;">Correo: {{ $billboard['user']['email'] }}</span>
            </p>
          </div>
          <div class="center">ESPACIO {{ strtoupper($billboard['state']) }} "{{ strtoupper($billboard['city']) }}"</div>
        </div>
        <div style='width:100%; text-align:center;'>
          <img style='height: 600px;' src="{{$billboard['img']}}"/>
        </div>
        <div style="width: 100%;">
          <table class="styled-table">
            <thead>
              <tr>
                <th colspan="7" align="center">DATOS GENERALES</th>
              </tr>
            <thead>
            <tbody>
              <tr>
                <td colspan="2"><strong>Ciudad: </strong>{{ $billboard['city'] }}</td>
                <td colspan="2"><strong>Zona: </strong>{{ $billboard['zone'] }}</td>
              </tr>
              <tr>
                <td colspan="5"><strong>Ubicación: </strong>{{ $billboard['location'] }}</td>
              </tr>
              <tr>
                <td colspan="2"><strong>Dimensión: </strong>{{ $billboard['dimension'] }}</td>
                <td colspan="2"><strong>Costo: </strong>{{ $billboard['price'] }}</td>
              </tr>
              <tr>
                <td colspan="2"><strong>Iluminación: </strong>{{ $billboard['illumination'] }}</td>
                <td><strong>Tipo: </strong>{{ $billboard['type'] }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="detail">
          <div><strong>Publicidad Vial Imagen S.R.L © {{ date('Y') }}</strong></div>
          <div>@if($billboard['office']['city'] == 'La Paz') {{ $billboard['office']['address'] }} {{ $billboard['office']['detail'][1] }} @else {{ $billboard['office']['address'] }} @endif</div>
          <div>Telf.: {{ $billboard['office']['phone_one'] }}  @if($billboard['office']['phone_two']) - {{ $billboard['office']['phone_two'] }} @endif</div>
          <div>{{ $billboard['office']['city'] }} - Bolivia</div>
          <div>
            <img src="{{url('/img/chrome.svg')}}"/> 
            <a href="https://imagenpublicidad.com.bo/">http://imagenpublicidad.com.bo/</a>
          </div>
          <div>
            <img src="{{url('/img/facebook.svg')}}"/> 
            <a href="https://www.facebook.com/imagenpublicidasantacruz">https://www.facebook.com/imagenpublicidasantacruz</a>
          </div>
        </div>
        <div class="qr">
          <div style="margin-left:70%; margin-right: 0;">
          {!! QrCode::size(200)->eye('circle')->style('round')->generate('jajajajaj'); !!}
          </div>
        </div>
      </div>
    </div>
  @endforeach
</body>
</html>
