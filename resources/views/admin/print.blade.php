<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
    body {
        margin-top: 20px;
        background-color: #f7f7ff;
    }

    #invoice {
        padding: 0px;
    }

    .invoice {
        position: relative;
        background-color: #FFF;
        min-height: 680px;
        padding: 15px
    }

    .invoice header {
        padding: 10px 0;
        margin-bottom: 20px;
        border-bottom: 1px solid #0d6efd
    }

    .invoice .company-details {
        text-align: right
    }

    .invoice .company-details .name {
        margin-top: 0;
        margin-bottom: 0
    }

    .invoice .contacts {
        margin-bottom: 20px
    }

    .invoice .invoice-to {
        text-align: left
    }

    .invoice .invoice-to .to {
        margin-top: 0;
        margin-bottom: 0
    }

    .invoice .invoice-details {
        text-align: right
    }

    .invoice .invoice-details .invoice-id {
        margin-top: 0;
        color: #0d6efd
    }

    .invoice main {
        padding-bottom: 10px
    }

    .invoice main .thanks {
        margin-top: -100px;
        font-size: 2em;
    }

    .invoice main .notices {
        padding-left: 6px;
        border-left: 6px solid #0d6efd;
        background: #e7f2ff;
        padding: 10px;
    }

    .invoice main .notices .notice {
        font-size: 1.2em
    }

    .invoice table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px
    }

    .invoice table td,
    .invoice table th {
        padding: 15px;
        background: #eee;
        border-bottom: 1px solid #fff
    }

    .invoice table th {
        white-space: nowrap;
        font-weight: 400;
        font-size: 16px
    }

    .invoice table td h3 {
        margin: 0;
        font-weight: 400;
        color: #0d6efd;
        font-size: 1.2em
    }

    .invoice table .qty,
    .invoice table .total,
    .invoice table .unit {
        text-align: right;
        font-size: 1.2em
    }

    .invoice table .no {
        color: #fff;
        font-size: 1.6em;
        background: #0d6efd
    }

    .invoice table .unit {
        background: #ddd
    }

    .invoice table .total {
        background: #0d6efd;
        color: #fff
    }

    .invoice table tbody tr:last-child td {
        border: none
    }

    .invoice table tfoot td {
        background: 0 0;
        border-bottom: none;
        white-space: nowrap;
        text-align: right;
        padding: 10px 20px;
        font-size: 1.2em;
        border-top: 1px solid #aaa
    }

    .invoice table tfoot tr:first-child td {
        border-top: none
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0px solid rgba(0, 0, 0, 0);
        border-radius: .25rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
    }

    .invoice table tfoot tr:last-child td {
        color: #0d6efd;
        font-size: 1.4em;
        border-top: 1px solid #0d6efd
    }

    .invoice table tfoot tr td:first-child {
        border: none
    }

    .invoice footer {
        width: 100%;
        text-align: center;
        color: #777;
        border-top: 1px solid #aaa;
        padding: 8px 0
    }

    @media print {
        .invoice {
            font-size: 11px !important;
            overflow: hidden !important
        }

        .invoice footer {
            position: absolute;
            bottom: 10px;
            page-break-after: always
        }

        .invoice>div:last-child {
            page-break-before: always
        }
    }

    .invoice main .notices {
        padding-left: 6px;
        border-left: 6px solid #0d6efd;
        background: #e7f2ff;
        padding: 10px;
    }

    /* media print */
    @media print {
        .invoice {
            font-size: 11px !important;
            overflow: hidden !important
        }

        .invoice footer {
            position: absolute;
            bottom: 10px;
            page-break-after: always
        }

        .invoice>div:last-child {
            page-break-before: always
        }
    .hidden-print{
        display: none;
    }
        
    }
    </style>
</head>

<body>
    <?php
    $bill = $bill[0];

    ?>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div id="invoice">
                    <div class="toolbar hidden-print">
                        <div class="text-end">
                            <button onclick="window.print();" class="btn btn-dark">
                                <i class="fa fa-print"></i>
                                Print
                            </button>
                        </div>
                        <hr>
                    </div>
                    <div class="invoice overflow-auto">
                        <div style="min-width: 600px">
                            <main>
                                
                                <h1 class="text-center mb-4">ESDC Store</h1>
                                <div class="row contacts">
                                    <div class="col invoice-to">
                                        <h3 class="to">{{$bill->name}}</h3>
                                        <div class="address">?????a ch???: {{$bill->address}} - {{$bill->district}} - {{$bill->city}} - {{$bill->province}}</div>
                                        <div class="email">
                                            <a href="mailto:{{$bill->email}}">{{$bill->email}}</a>
                                        </div>
                                    </div>
                                    <div class="col invoice-details">
                                        <h3 class="invoice-id">M?? ho?? ????n: {{$bill->id}}</h3>
                                        <div class="date">Th???i gian mua: {{date_format(date_create($bill->orderTime), 'H:i d/m/Y')}}</div>
                                        <div class="date">Th???i gian in: {{date_format(date_create(now('Asia/Ho_Chi_Minh')), 'H:i d/m/Y')}}</div>
                                    </div>
                                </div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th class="text-left">T??n s???n ph???m</th>
                                            <th class="text-right">Gi?? s???n ph???m</th>
                                            <th class="text-right">S??? l?????ng</th>
                                            <th class="text-right">Th??nh ti???n</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bill->items as $key => $item)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>
                                                <h3>{{$item->name}}</h3>
                                            </td>
                                            <td class="unit">{{$item->price}}</td>
                                            <td class="qty">{{$item->qty}}</td>
                                            <td class="total">{{number_format($item->price)}} VN??</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">T???ng ti???n</td>
                                            <td>{{number_format($bill->total)}} VN??</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">VAT</td>
                                            <td>0 VN??</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">Khuy???n m??i</td>
                                            <td>0 VN??</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">Th??nh ti???n</td>
                                            <td>{{number_format($bill->total)}} VN??</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </main>
                            <p class="text-center">C???m ??n qu?? kh??ch!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>