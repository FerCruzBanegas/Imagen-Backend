<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Orden de Trabajo</title>
    <style>
      .invoice-box {
        max-width: 100%;
        margin: auto;
        padding: 30px;
        font-size: 16px;
        line-height: 24px;
        color: #555;
      }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.0/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="invoice-box">
      <div class="float-right font-weight-bold">{{ date('d/m/Y') }}</div>
      <table class="table table-bordered table-sm">
        <tr class="text-center">
          <td width="200" class="font-weight-bold">Número de OT</td>
          <td rowspan="3" width="500">
            <div><img src="{{url('/img/favicon.png')}}" width="50"/><h1>ORDEN DE TRABAJO</h1></div>
          </td>
          <td width="200" class="font-weight-bold">Nro de Cotización</td>
        </tr>
        <tr class="text-center">
          <td rowspan="2" style="padding: 18px">{{ str_pad($workorder['work_order']['number'], 6, '0', STR_PAD_LEFT) }}</td>
          <td>{{ $workorder['cite'] }}</td>
        </tr>
        <tr class="text-center">
          <td>
            @if($workorder['work_order']['closing_date'])
              <h5><span class='badge badge-success'>ENTREGADO</span></h5>
            @else
              <h5><span class='badge badge-primary'>EN CURSO</span></h5>
            @endif
          </td>
        </tr>
      </table>
      <table class="table table-striped table-bordered table-hover">
        <tbody>
          <tr class="text-center">
            <th width="300">FECHA DE INICIO:</th>
            <th width="300">FECHA ESTIMADA:</th>
            <th width="300">FECHA DE ENTREGA:</th>
          </tr>
          <tr class="text-center">
            <td>{{ date('d/m/Y', strtotime($workorder['work_order']['opening_date'])) }}</td>
            <td>{{ date('d/m/Y', strtotime($workorder['work_order']['estimated_date'])) }}</td>

            @if($workorder['work_order']['closing_date'])
              <td>{{ date('d/m/Y', strtotime($workorder['work_order']['closing_date'])) }}</td>
            @else
              <td>-------</td>
            @endif
          </tr>
          <tr>
            <th colspan="3">RESPONSABLE DE TRABAJO:</th>
          </tr>
          <tr>
            <td colspan="3">
              @foreach($workorder['work_order']['employees'] as $index => $employee)
                @php($total = $index + 1) 
                <span>{{ $employee['name'] }} {{ $total < count($workorder['work_order']['employees']) ? ',' : '' }}</span>
              @endforeach
            </td>
          </tr>
          <tr>
            <th colspan="3">TIPO DE TRABAJO:</th>
          </tr>
          <tr>
            <td colspan="3">{{ $workorder['work_order']['type_work'] }}</td>
          </tr>
          <tr>
            <th colspan="3">OBSERVACIONES:</th>
          </tr>
          <tr>
            <td colspan="3">{{ $workorder['work_order']['note'] }}</td>
          </tr>
          <tr>
            <th colspan="3" class="text-center"><span class="h5 font-weight-bold">DATOS DE ENTREGA</span></th>
          </tr>
          <tr>
            <td colspan="3"><strong>Persona de Contacto:</strong> {{ $workorder['attends'] }}</td>
          </tr>
          <tr>
            <td colspan="3"><strong>Teléfono Persona de Contacto:</strong> {{ $workorder['attends_phone'] }}</td>
          </tr>
          <tr>
            <td colspan="3"><strong>Dirección de Entrega:</strong> {{ $workorder['installment'] }}</td>
          </tr>
          @if($workorder['work_order']['city_id'])
            <tr>
              <th colspan="3" class="text-center"><span class="h5 font-weight-bold">INSTALACIÓN O ENTREGA EN EL INTERIOR</span></th>
            </tr>
            <tr>
              <td colspan="3"><strong>Ciudad de Instalación/Entrega:</strong> {{ $workorder['work_order']['city_id']['name'] }}</td>
            </tr>
            <tr>
              <td colspan="3"><strong>Normbre del Personal Acargo de la Instalación/Entrega:</strong> {{ $workorder['work_order']['name_staff'] }}</td>
            </tr>
            <tr>
              <td colspan="3"><strong>Dirección del Trabajo:</strong> {{ $workorder['work_order']['address_work'] }}</td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
  </body>
</html>