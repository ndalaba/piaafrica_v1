@extends('emails.layout')
@section('content')
    <br>

    <br>
    <center>
        <small>Vous recevez cet email car vous avez cr&eacute;&eacute; un compte sur PIA AFRICA</small>
    </center>

    <p>
        Bonjour {{$param['name']}},
    </p>

    <p>
        Vous avez fait une demande de r&eacute;initialisation de votre mot de passe Pia Africa.
    </p>

    <p>
        Vous pouvez le faire en cliquant ci-dessous :
    </p>

    <center>
        <table cellpadding="0" cellspacing="0" border="0" width="300" style="border-radius: 4px; border-top-color: ##b22222; border-top-style: solid; border-top-width: 1px">
            <tbody>
            <tr>
                <td align="center" height="100%" width="100%" style="background-color: #b22222; border-bottom-color: #b22222; border-bottom-style: solid; border-bottom-width: 0px; border-radius: 4px; border-top-color: #b22222; border-top-style: solid; border-top-width: 0px; color: #ffffff; display: block; padding-bottom: 3px; padding-top: 3px" bgcolor="#b22222">

                    <a href="{{ url('inquire/password/edit?reset_password_token='.$param['reset_password_token'].'&email='.$param['email']) }}" target="_blank" style="color: #ffffff; display: block; font-family: Arial,sans-serif; font-size: 17px; font-weight: bold; line-height: 19px; padding-bottom: 4px; padding-left: 5px; padding-right: 5px; padding-top: 4px; text-decoration: none">
                        R&eacute;initialiser mon mot de passe
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
    </center>
    <br>

    <p>
        Si vous n'avez pas fait de demande de changement de mot de passe, vous pouvez ignorer cet email.
    </p>
@endsection
