<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cotización</title>
    
    <style>
    h1 {
        text-transform: uppercase;
        letter-spacing: 1pt;
        font-size: 30pt;
        margin-bottom: 15px;
    }

    .text-right {
        text-align: right;
    }

    .text-center {
        text-align: center;
    }

    .text-content {
        text-align: center;
        font-weight: bold;
        font-size: 10pt;
    }

    .text-title {
        text-align: center;
        font-weight: bold;
        font-size: 12pt;
        color: #000;
    }
    
    .invoice-box {
        max-width: 100%;
        margin: auto;
        padding: 30px;
        border: 2px solid #000;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .car-data table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .car-data table td {
        padding: 5px;
    }
    
    .car-data table tr.top table td {
        padding-bottom: 20px;
    }
    
    .car-data table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
        padding: 0px;
    }
    
    .car-data table tr.information table td {
        padding-bottom: 40px;
    }
    
    .car-data table tr.heading td {
        background: #f9f9f9;
        border-top: 1px solid #000;
        border-right: 1px solid #000;
        border-left: 1px solid #000;
        border-bottom: 1px solid #000;
    }

    .car-data table tr.heading-float td {
        background: #f9f9f9;
        border-right: 1px solid #000;
        border-left: 1px solid #000;
        border-bottom: 1px solid #000;
    }
    
    .car-data table tr.details td {
        padding-bottom: 20px;
    }
    
    .car-data table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .car-data table tr.item.last td {
        border-bottom: none;
    }
    
    .car-data table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }

    .car-items table {
        border-collapse: collapse;
        width: 100%;
    }

    .car-items table td, th {
        border: 1px solid #000;
        padding: 3px;
    }

    .car-items table thead tr {
        background: #ca0000;
        color: #fff;
    }

    .thubnail img {
        float: left;
        width:50%;
        box-sizing: border-box;
        padding: 0.2em;
        height: 245px;
    }

    .details {
        border: 1px solid #000; 
        padding: 3px;
    }

    .signature {
        width: 400px; 
        margin: 100px auto; 
        margin-bottom: 0;
        border-top: 1px solid #000; 
        text-align: center;
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <div class="car-data">
            <table cellpadding="0" cellspacing="0">
                <tr class="top">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td class="title">
                                    <img src="{{url('/img/logo.png')}}" style="width:300px;">
                                </td>
                                <td class="text-right">
                                    {{ $quotation->office->city->name }} - Bolivia<br>
                                    <strong>{{ date('d/m/Y', strtotime($quotation->date)) }}</strong><br>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
                <tr class="information">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td width="50%">
                                    {{ $quotation->office->address }}<br>
                                    Teléf-Fax: (591) {{ $quotation->office->phone_one }} @if($quotation->office->phone_two) - {{ $quotation->office->phone_two }} @endif<br>
                                </td>
                                <td width="50%" align="right">
                                    <strong>Usuario: </strong>{{ ucwords($quotation->user->name) }}<br>
                                    E-mail: {{ $quotation->user->email }}<br>
                                    Cel: {{ $quotation->user->phone }}
                                </td>
                                <td>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
                <tr class="heading">
                    <td width="70%">
                        <strong>Cliente:</strong> {{ $quotation->customer->business_name }}
                    </td>
                    
                    <td>
                        <strong>NIT:</strong> {{ $quotation->customer->nit }}
                    </td>
                </tr>

                <tr class="heading-float">
                    <td width="70%">
                        <strong>Contacto:</strong> {{ $quotation->attends }}
                    </td>
                    
                    <td rowspan="2">
                        <strong>E-mail:</strong> {{ $quotation->customer->email }}
                    </td>
                </tr>

                <tr class="heading-float">
                    <td width="70%">
                        <strong>Teléfono / Cel:</strong> {{ $quotation->attends_phone }}
                    </td>
                    
                </tr>

                <tr class="heading-float">
                    <td width="70%">
                        <strong>Dirección / Instalación:</strong> {{ $quotation->installment }} 
                    </td>
                    <td>
                        <strong>CITE:</strong> {{ $quotation->cite }}
                    </td>
                </tr>
            </table>
        </div>
        <br>
        <div class="car-items">
        <div style="border: 1px solid black; border-bottom: none; text-align: center; font-size: 50px; padding: 20px; font-weight: bold;">PROFORMA</div>
            <table>
                <thead class="text-center">
                    <!-- <tr>
                        <td colspan="6"><h1>PRO FORMA</h1></td>
                    </tr> -->
                    <tr>
                        <td width="8%">Item</td>
                        <td width="8%">Cantidad</td>
                        <td width="10%">Dimensión</td>
                        <td width="50%">Descripción</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quotation->products as $key => $product)   
                        <tr style="page-break-inside: avoid;">
                            <td class="text-content">{{ $key + 1 }}</td>
                            <td class="text-content">{{ $product->pivot->quantity }}</td>
                            <td class="text-content">{{ $product->pivot->dimension }}</td>
                            <td class="text-title">{{ $product->name }}
                                <div class="text-content" style="text-align: justify;">
                                    @if ($product->pivot->materialCheck)
                                        <b>Material</b>: {{ $product->pivot->material }}
                                    @endif
                                    @if ($product->pivot->qualityCheck)
                                        <b>Calidad</b>: {{ $product->pivot->quality }}
                                    @endif
                                    @if ($product->pivot->finishCheck)
                                        <b>Acabado</b>: {{ $product->pivot->finish }}
                                    @endif
                                    {{ $product->pivot->description }}
                                    @if (!empty($product->pivot->images))
                                        @foreach($product->pivot->images as $image) 
                                            <div class="thubnail">
                                                <img src="{{ $image->url_path }}">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @php($total = $quotation->products()->sum('subtotal') - $quotation->discount)
                </tbody>
            </table>
        </div>
        <div style="page-break-inside: avoid;">
            <div class="details"><strong>Plazo de Entrega:</strong>
            @if ($quotation->term) 
              {{ date('d/m/Y', strtotime($quotation->term)) }}
            @else 
              S/D
            @endif 
            </div>
            <div class="details"><strong>Forma de Pago:</strong> {{ $quotation->payment }}</div>
            <div class="details"><strong>Validez Cotización:</strong> {{ $quotation->validity }}</div>
            <div class="details"><strong>Observación:</strong> {{ $quotation->note }}</div>
            <div class="signature">
                <div>{{ $quotation->user->forename }} {{ $quotation->user->surname }}</div>
                <strong>Publicidad Vial Imagen SRL.</strong>
            </div>
        </div>
    </div>
</body>