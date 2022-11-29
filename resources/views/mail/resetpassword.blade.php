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
    color:#2e2e2e;
    font-size: 38px;
    font-weight: 600;
    font-style: normal;
    line-height: 36px;
    font-family: "Fredoka", sans-serif;
    margin: 10px 0;
    text-align: center;
}
.template .table .date-time{
    padding-bottom:5px;
}
.template .table .date-time h6{
    font-size: 16px;
    font-weight: normal;
    font-style: normal;
    line-height: 20px;
    font-family: "Fredoka", sans-serif;
    margin:0px;
}
.template .table tbody .head th{
    text-align: center;
    font-size:12px;
    line-height:16px;
    color:#444;
    text-transform:uppercase;
}
.template .table tbody td {
    text-align: center;
    color:#444;
    font-size:13px;
    font-weight:400;
    line-height:21px;
    width:50%;
    margin-bottom: 20px;
}
.template .table tfoot{
    height:90px;
    background-color:#2e2e2e;
}
.template .table tfoot .footer{
    padding:0 30px;
}
.template .table tfoot .footer img{
    vertical-align:middle;
}
.template .table tfoot .footer span,address{
    color: white;
    font-size: 16px;
    font-weight: 600;
    font-style: normal;
    line-height: 36px;
    font-family: "Fredoka", sans-serif;
}
address{
    text-align:right;
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
    font-weight: normal;
    font-style: normal;
    line-height: 20px;
    font-family: "Fredoka", sans-serif;
    margin: 0px;
}

.button-container {
    margin-bottom: 20px;
}

p{
    text-align: center;
    margin: 20px;
    font-size: 18px;
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
            <tbody style="height: 100px;">

                <tr>
                    <td colspan="2">
                            <p>Please click here to change your password</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="button-container">
                            <a href="{{ route('reset-password') }}?email={{ encrypt($email) }}" class="reset_button">Reset Password</a>
                        </div>
                    </td>
                </tr>

            </tbody>

            <tfoot>
                <tr>
                    <td class="footer">
                        <img src="{{ asset('images/logo.png') }}" alt="Credifana logo" width="30" height="30">
                        <span>Credifana@2021</span>
                    </td>
                    <td class="footer">
                        <address>
                            CREDIFANA
                        </address>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</html>