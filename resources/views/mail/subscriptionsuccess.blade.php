<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            display: flex;
            justify-content: center;
            font-family: "Fredoka", sans-serif;
            color: #2e2e2e;
        }
        #email_template_container{
            width: 600px;
            max-width: 600px;
            border-radius: 10px;
            margin:auto;
        }
        .email-logo{
            max-width: 100%;
            height: 30px;
            width: 30px;
        }
        .logo-name{
            color: #748eff;
            margin-bottom: 0;
            margin-left: 10px;
            font-size: 40px;
            font-weight: bold;
        }
        .logo-heading-container{
            border-bottom: 1px solid #dbdbdb;
        }
        .logo-heading-container h1{
            font-size: 20px;
            font-weight: normal;
        }
        .greetings{
            margin-top: 50px;
        }
        .description p{
            line-height: 20px;
        }
        .plan-table{
            border: 1px solid #dbdbdb;
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        .plan-table tr{
            text-align: center;
        }
        .plan-table thead tr{
            background-color: #748eff;
        }
        .plan-table thead tr th{
            padding: 10px;
            border: 1px solid #dbdbdb;
            color: white;
        }
        .plan-table tbody tr{
            background-color: #f1f1f1;
        }
        .plan-table tbody tr td{
            padding: 10px;
            border: 1px solid #dbdbdb;
        }
        .footer-logo-name{
            font-size: 20px;
            margin-left: 5px;
        }
        .footer-email-logo{
            height: 20px;
            width: 20px;
        }
        .email-template-footer{
            display: block;
            padding: 10px 0px;
            margin-top: 20px;
            border-top: 1px solid #dbdbdb;
        }
        .email-template-footer tr{
            display: block;
        }
        .email-template-footer tr .privacy-terms a{
            text-decoration: none;
            color: #2e2e2e;
        }
        .footer-logo-container{
            float: left;
        }
        .privacy-terms{
            float: right;
        }
        .social-btn{
            padding: 10px;
            color: white !important;
            text-decoration: none;
            font-size: 14px;
        }
        .facebook{
            background-color: #1877f2;
        }
        .youtube{
            background-color: #d30606;
        }
        .youtube img{
            margin-right: 5px;
        }
        .facebook-container,fb{
            float:left;
            color:white !important;
        }
        .youtube-container,yt{
            float:right;
            color:white !important;
        }
    </style>
</head>
<body>
    <table id="email_template_container">
        <thead>
            <tr>
                <th class="logo-heading-container">
                    <img src="https://credifana.com/images/logo.png" alt="primary logo" class="email-logo">
                    <span class="logo-name">Credifana</span>
                    <h1>Rental Property Calculator And Analysis</h1>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <p class="greetings">Hello, {{ $username }}</p>
                    <span><?php echo date('jS F Y  h:i A') ?></span>
                </td>
            </tr>
            <tr>
                <td class="description">
                    <p>Thank you for subscribing with Credifana, your subscription is now activated.</p>
                </td>
            </tr>
            <tr>
                <td>
                    <table class="plan-table">
                        <thead>
                            <tr>
                                <th>Plan</th>
                                <th>Total Request</th>
                                <th>Start Date</th>
                                <th>Renewal Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $plan_type }}</td>
                                <td>{{ $total_click }}</td>
                                <td>{{ $plan_start }}</td>
                                <td>{{ $plan_end }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr class="social-container">
                <td class="facebook-container">
                    <a href="https://www.facebook.com/groups/1167762780759149" target="_blank" class="facebook social-btn">
                        <img src="https://credifana.com/images/facebook.png" alt="facebook"> Join our Facebook Community
                    </a>
                </td>
                <td class="youtube-container">
                    <a href="https://www.youtube.com/channel/UCqDevzLF3mUkAt1t76EH1sQ" target="_blank" class="youtube social-btn">
                        <img src="https://credifana.com/images/youtube.png" alt="youtube"> Subscribe To Credifana
                    </a>
                </td>
            </tr>
        </tbody>
        <tfoot class="email-template-footer">
            <tr>
                <td class="footer-logo-container">
                    <img src="https://credifana.com/images/logo.png" alt="primary logo" class="email-logo footer-email-logo">
                    <span class="logo-name footer-logo-name">Credifana</span>
                </td>
                <td class="privacy-terms">
                    <span>2023</span>
                    <a href="https://credifana.com/privacy-policy">Privacy policy</a>
                    <span>|</span>
                    <a href="https://credifana.com/terms-of-use">terms of use</a>
                </td>
            </tr>
        </tfoot>
    </table>
</body>
</html>