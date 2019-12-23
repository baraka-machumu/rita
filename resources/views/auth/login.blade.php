<?php


?>
    <!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <link type="text/css" rel="stylesheet" href="resource/theme.css" />
    <link type="text/css" rel="stylesheet" href="resource/css/font-icon-layout.css" />
    <link type="text/css" rel="stylesheet" href="resource/css/sentinel-layout.css" />
    <link type="text/css" rel="stylesheet" href="resource/css/core-layout.css" />
    <link type="text/css" rel="stylesheet" href="resource/ritaLoginStyles.css" />
    <link type="text/css" rel="stylesheet" href="resource/primefaces.css" />

    <script type="text/javascript" src="resource/jquery/jquery.js"></script>
    <script type="text/javascript" src="resource/primefaces.js"></script>
    <script type="text/javascript" src="resource/jquery/jquery-plugins.js"></script>
    <script type="text/javascript">if(window.PrimeFaces){}</script>
    <title>Online registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <script type="text/javascript" src="resource/js/login.js"></script>

</head>

<body class="fontRegular custom-background">
<table style="width:100%; height:100%;">
    <tr style="width:100% !important; height:100% !important;">
        <td style="width:50%;height:100% ">
            <div class="Container80"><img src="{{asset(url('/public/resource/images/CRS9.png'))}}" class="Fcenter" />
            </div>
        </td>
        <td style="width:50%;height:100%">
            <div class="Container80Right">


                <div class="Container80 MaxWid400 white-back Fnone BordRad10 Fright" id="login-box">
                    <div class="Container" style="background-color:#1578c9">
                        <div class="EmptyBox10"></div>
                        <div class="Container70" style="margin-top:10px;">
                            <div class="Container20"> </div>
                            <div class="Container80 Fnone MarAuto Fs20 white"><font size="4" face="Cambria"><b>LOGIN</b></font></div>
                            <div class="EmptyBox5"></div>
                            <div class="Container20"> </div>
                            <div class="Container80 Fnone MarAuto white"><font size="4" face="Cambria"> Online Registration System</font></div>
                        </div>
                        <div class="Container25 TexAlCenter Animated05 left " role="1" style="background-color:#1578c9"><img src="resource/images/ritalogo.png" class="Fright" />
                        </div>
                        <div class="EmptyBox10"></div>
                    </div>
                    <div class="EmptyBox20"></div>
                    <div class="Container">
                        <form id="loginForm" name="loginForm" method="post" action="{{url('/login')}}" enctype="application/x-www-form-urlencoded">
                            {{csrf_field()}}

                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))

                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close"></a></p>
                                @endif
                            @endforeach
                            <div class="Container90 Fnone MarAuto TexAlCenter TabContent OvHidden" id="TAB1"><?php //echo $_SESSION['fg'];$_SESSION["fg"]=NULL;?>

                                <div class="EmptyBox10"></div>
                                <font size="4" face="Cambria">
                                    <input id="loginForm:j_idt24" name="email" value="{{old('email')}}" type="text" placeholder="Username: *" aria-required="true" class="ui-inputfield ui-inputtext ui-widget ui-state-default ui-corner-all Container80 Fnone MarAuto Fs18" /></font>
                                <script id="loginForm:j_idt24_s" type="text/javascript">PrimeFaces.cw("InputText","widget_loginForm_j_idt24",{id:"loginForm:j_idt24"});</script>
                                <div class="EmptyBox20"></div><font size="4" face="Cambria"><input id="loginForm:j_idt26" name="password" type="password" class="ui-inputfield ui-password ui-widget ui-state-default ui-corner-all Container80 Fnone MarAuto Fs18" placeholder="Password: *" aria-required="true" /></font>
                                <script id="loginForm:j_idt26_s" type="text/javascript">$(function(){PrimeFaces.cw("Password","widget_loginForm_j_idt26",{id:"loginForm:j_idt26"});});</script>
                                <div class="EmptyBox20"></div><button  name="submit" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only Fs16"  type="submit"><span class="ui-button-text ui-c"><font size="4" face="Cambria">Login </font></span></button>
                                <script id="loginForm:j_idt28_s" type="text/javascript">PrimeFaces.cw("CommandButton","widget_loginForm_j_idt28",{id:"loginForm:j_idt28"});</script>
                                <div class="EmptyBox10"></div><a href="/rita-crvs/pages/unsecure/forgotPassword.xhtml" class="ui-link ui-widget"><font size="4" face="Cambria">Forgot Password?</font></a>
                                <div class="EmptyBox20"></div>
                            </div>

                        </form>
                    </div>
                </div>
            </div><script id="j_idt33_s" type="text/javascript">$(function(){PrimeFaces.cw("ConfirmDialog","loginConfirm",{id:"j_idt33",showEffect:"fade",hideEffect:"fade",global:true});});
            </script><div id="j_idt33" class="ui-confirm-dialog ui-dialog ui-widget ui-widget-content ui-corner-all ui-shadow ui-hidden-container"><div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-top">
                    <span class="ui-dialog-title"></span><a href="#" class="ui-dialog-titlebar-icon ui-dialog-titlebar-close ui-corner-all"><span class="ui-icon ui-icon-closethick"></span></a></div><div class="ui-dialog-content ui-widget-content"><span class="ui-icon ui-confirm-dialog-severity">

                    </span><span class="ui-confirm-dialog-message">User is already loggedin. Please Logout or wait till system logouts the user.</span></div><div class="ui-dialog-buttonpane ui-dialog-footer ui-widget-content ui-helper-clearfix">
                    <button id="j_idt34" name="j_idt34" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-confirmdialog-yes" onclick="PrimeFaces.ab({s:&quot;j_idt34&quot;});return false;" type="submit"><span class="ui-button-text ui-c">Yes</span></button>
                    <script id="j_idt34_s" type="text/javascript">PrimeFaces.cw("CommandButton","widget_j_idt34",{id:"j_idt34"});</script>
                    <button id="j_idt35" name="j_idt35" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-confirmdialog-no" onclick="PrimeFaces.ab({s:&quot;j_idt35&quot;});return false;" type="submit">
                        <span class="ui-button-text ui-c">No</span></button><script id="j_idt35_s" type="text/javascript">PrimeFaces.cw("CommandButton","widget_j_idt35",{id:"j_idt35"});</script></div></div>

        </td></tr>
</table>
<script>
    window.setTimeout(function() {

        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });

    }, 4000);</script></body>

</html><?php

?>
