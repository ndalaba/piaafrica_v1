<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
<html>
<head></head>
<body style="color: #4d4d4d">
<table align="middle" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; border-collapse: collapse; font-family: arial; line-height: 100% !important; margin-bottom: auto; margin-left: auto; margin-right: auto; margin-top: auto; max-width: 600px; mso-table-lspace: 0pt; mso-table-rspace: 0pt; padding-bottom: 0; padding-left: 0; padding-right: 0; padding-top: 0; width: 100%" bgcolor="#ffffff">
    <tr>
        <td>
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td height="60px" align="center">
                        <a href="{{ url('/') }}" title="lien vers {{ config('application.name') }}">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo {{ config('application.name') }}" style="width: 150px">
                        </a>
                    </td>
                </tr>
            </table>

            <br>

            <h1>{{ $request['sujet'] }}</h1>

            <p>{{ $request['message'] }}</p>

            <br>
            <table align="middle" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; border-collapse: collapse; font-family: arial; line-height: 100% !important; margin-bottom: auto; margin-left: auto; margin-right: auto; margin-top: auto; max-width: 600px; mso-table-lspace: 0pt; mso-table-rspace: 0pt; padding-bottom: 0; padding-left: 0; padding-right: 0; padding-top: 0; width: 100%" bgcolor="#ffffff">
                <tr>
                    <td>
                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                            <tr>
                                <td height="40px" align="center">
                                    <p><span style="font-size: 10px;">SITE WEB <a href="{{ url('') }}" target="_blank">{{ url('') }}</a><br>
                                        PAGE FACEBOOK&nbsp;<a href="https://www.facebook.com/piaafrica">https://www.facebook.com/piaafrica</a><br>
                                        </span></p>
                                </td>
                            </tr>
                        </table>
                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                            <tr>
                                <td style="border-bottom-color: #FAFAFA; border-bottom-style: solid; border-bottom-width: 1px; height: 30px">
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
