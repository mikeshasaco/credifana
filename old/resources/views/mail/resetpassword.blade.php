<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Inquiry</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=PT+Sans&display=swap');
        *{
            box-sizing:border-box;
        }
        body{
            font-family:'PT Sans',sans-serif;
            margin:0;
            background-color:transparent;
        }
        .template{
            max-width:600px;
            margin:auto;
        }
        .template .table{
            border-collapse:collapse;
            width:100%;
            background-color:#fff;
            border-radius:20px;
            overflow:hidden;
        }
        .template .table thead{
            border-bottom:6px solid #f0f0f0;
        }
        .template .table .mail-img{
            height:120px;
            background-color:#748eff;
        }
        .template .table .mail-img img{
            transform:translateY(19px);
        }
        .template .table .mail-heading h1{
            color:#003380;
            font-size:38px;
            line-height:51px;
            font-weight:400;
            text-transform:uppercase;
            margin-bottom:0;
        }
        .template .table .date-time{
            padding-bottom:5px;
        }
        .template .table .date-time h6{
            display:inline-block;
            text-align:center;
            font-size:14px;
            color:#003380;
            font-weight:400;
            line-height:19px;
            margin:0;
        }
        .template .table tbody .head th{
            text-align:left;
            font-size:12px;
            line-height:16px;
            color:#444;
            text-transform:uppercase;
        }
        .template .table tbody .content td{
            text-align:left;
            color:#444;
            font-size:13px;
            font-weight:400;
            line-height:21px;
            width:50%;
        }
        .template .table tfoot{
            height:90px;
            background-color:#adadad;
        }
        .template .table tfoot .footer{
            padding:0 30px;
        }
        .template .table tfoot .footer img{
            vertical-align:middle;
        }
        .template .table tfoot .footer span{
            font-size:16px;
            font-weight:400;
            line-height:21px;
            display:inline-block;
            color:#f2f7ff;
        }
        @media (max-width:500px){
            .template .table .mail-img{
                height:65px;
            }
            .template .table .mail-heading h1{
                font-size:22px;
                margin:12px 0 4px;
                line-height:normal;
            }
            .template .table .date-time{
                padding-bottom:18px;
            }
        }

        .reset_button {
            text-decoration: none;
            color: white;
            font-size: 18px;
            padding: 10px;
            background-color: #748eff;
            border-radius: 5px;
        }

        .container {
            height: 150px;
            text-align: center;
        }

    </style>

</head>

<body>
    <div class="template">
        <table class="table">
            <thead>
                <tr>
                    <th class="mail-img" colspan="2">
                        <img src="{{ asset('images/mail-box.png') }}" alt="Mail" height="100%">
                    </th>
                </tr>
                <tr>
                    <th class="mail-heading" colspan="2">
                        <h1>Reset Password</h1>
                    </th>
                </tr>
                <tr>
                    <th class="date-time" colspan="2">
                        <h6><?php echo date('jS F Y  h:i A') ?></h6>
                    </th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td colspan="2">
                        <div class="container">
                            <p>Please click here to change your password</p>
                            <div class="button-container">
                                <a href="{{ route('reset-password') }}" class="reset_button">Reset Password</a>
                            </div>
                        </div>
                    </td>
                </tr>

            </tbody>

            <tfoot>
                <tr>
                    <td class="footer">
                        <img src="{{ asset('images/logo.png') }}" alt="Credifana logo" width="30" height="30">
                        <span style="color:#2c2c2c;font-weight:bold;margin-top:8px;font-size:16px;">Credifana@2021</span>
                    </td>
                    <td style="font-size:15px; text-align:left">
                        <address>
                            CREDIFANA
                        </address>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>