<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Struk - {{ $transaction->invoice_code }}</title>
    <style>
        /* CSS PDF SEDERHANA */
        body {
            font-family: 'Courier New', monospace;
            /* Font Kasir */
            font-size: 10pt;
            /* Ukuran font pas */
            margin: 0;
            padding: 0;
            color: #000;
        }

        .container {
            width: 100%;
            padding: 5px;
        }

        .text-center {
            text-align: center;
        }

        .fw-bold {
            font-weight: bold;
        }

        .mb-1 {
            margin-bottom: 5px;
        }

        .header {
            border-bottom: 2px dashed #000;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .divider {
            border-bottom: 1px dashed #000;
            margin: 5px 0;
        }

        /* Tabel untuk Layout Rapi di PDF */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            vertical-align: top;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="header text-center">
            <h3 class="mb-1" style="margin:0;">CAFE SEMBADA</h3>
            <span style="font-size: 8pt;">Jl. Pendidikan No. 1, Jakarta</span>
        </div>

        <div class="text-center" style="margin-bottom: 10px;">
            <span style="border: 1px solid #000; padding: 2px 5px; font-size: 8pt;">ANTRIAN</span>
            <h1 style="font-size: 30pt; margin: 0;">{{ $transaction->id % 100 }}</h1>
        </div>

        <div class="divider"></div>

        <table style="font-size: 8pt;">
            <tr>
                <td>No</td>
                <td class="text-right">{{ $transaction->invoice_code }}</td>
            </tr>
            <tr>
                <td>Tgl</td>
                <td class="text-right">{{ $transaction->created_at->format('d/m/y H:i') }}</td>
            </tr>
            <tr>
                <td>Kasir</td>
                <td class="text-right">{{ Auth::user()->name ?? 'Admin' }}</td>
            </tr>
        </table>

        <div class="divider"></div>

        <table style="font-size: 9pt;">
            @foreach($transaction->details as $detail)
                <tr>
                    <td colspan="2" class="fw-bold">{{ $detail->product->name }}</td>
                </tr>
                <tr>
                    <td>{{ $detail->qty }} x {{ number_format($detail->price_at_transaction, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($detail->qty * $detail->price_at_transaction, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
        </table>

        <div class="divider"></div>

        <table style="font-size: 10pt; font-weight: bold;">
            <tr>
                <td>TOTAL</td>
                <td class="text-right">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
            </tr>
        </table>

        <div style="font-size: 8pt; margin-top: 5px;">
            Metode: {{ $transaction->payment_method }}
        </div>

        <div class="divider"></div>

        <div class="text-center" style="margin-top: 10px; font-size: 8pt;">
            <i>Terima Kasih!</i><br>
            <i>Wifi: kopienak123</i>
        </div>
    </div>
</body>

</html>