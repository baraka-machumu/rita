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
                            <div class="Container90 Fnone MarAuto TexAlCenter TabContent OvHidden" id="TAB1"><?php //echo $_SESSION['fg'];$_SESSION["fg"]=NULL;?>

                                <div class="EmptyBox10"></div>
                                <font size="4" face="Cambria"><input id="loginForm:j_idt24" name="userName" type="text" placeholder="Username: *" aria-required="true" class="ui-inputfield ui-inputtext ui-widget ui-state-default ui-corner-all Container80 Fnone MarAuto Fs18" /></font>
                                <script id="loginForm:j_idt24_s" type="text/javascript">PrimeFaces.cw("InputText","widget_loginForm_j_idt24",{id:"loginForm:j_idt24"});</script>
                                <div class="EmptyBox20"></div><font size="4" face="Cambria"><input id="loginForm:j_idt26" name="pass" type="password" class="ui-inputfield ui-password ui-widget ui-state-default ui-corner-all Container80 Fnone MarAuto Fs18" placeholder="Password: *" aria-required="true" /></font>
                                <script id="loginForm:j_idt26_s" type="text/javascript">$(function(){PrimeFaces.cw("Password","widget_loginForm_j_idt26",{id:"loginForm:j_idt26"});});</script>
                                <div class="EmptyBox20"></div><button  name="submit" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only Fs16"  type="submit"><span class="ui-button-text ui-c"><font size="4" face="Cambria">Login </font></span></button>
                                <script id="loginForm:j_idt28_s" type="text/javascript">PrimeFaces.cw("CommandButton","widget_loginForm_j_idt28",{id:"loginForm:j_idt28"});</script>
                                <div class="EmptyBox10"></div><a href="/rita-crvs/pages/unsecure/forgotPassword.xhtml" class="ui-link ui-widget"><font size="4" face="Cambria">Forgot Password?</font></a>
                                <div class="EmptyBox20"></div>
                            </div><input type="hidden" name="javax.faces.ViewState" id="j_id1:javax.faces.ViewState:0" value="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" autocomplete="off" />
                        </form>
                    </div>
                </div>
            </div><script id="j_idt33_s" type="text/javascript">$(function(){PrimeFaces.cw("ConfirmDialog","loginConfirm",{id:"j_idt33",showEffect:"fade",hideEffect:"fade",global:true});});</script><div id="j_idt33" class="ui-confirm-dialog ui-dialog ui-widget ui-widget-content ui-corner-all ui-shadow ui-hidden-container"><div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix ui-corner-top"><span class="ui-dialog-title"></span><a href="#" class="ui-dialog-titlebar-icon ui-dialog-titlebar-close ui-corner-all"><span class="ui-icon ui-icon-closethick"></span></a></div><div class="ui-dialog-content ui-widget-content"><span class="ui-icon ui-confirm-dialog-severity"></span><span class="ui-confirm-dialog-message">User is already loggedin. Please Logout or wait till system logouts the user.</span></div><div class="ui-dialog-buttonpane ui-dialog-footer ui-widget-content ui-helper-clearfix"><button id="j_idt34" name="j_idt34" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-confirmdialog-yes" onclick="PrimeFaces.ab({s:&quot;j_idt34&quot;});return false;" type="submit"><span class="ui-button-text ui-c">Yes</span></button><script id="j_idt34_s" type="text/javascript">PrimeFaces.cw("CommandButton","widget_j_idt34",{id:"j_idt34"});</script><button id="j_idt35" name="j_idt35" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-confirmdialog-no" onclick="PrimeFaces.ab({s:&quot;j_idt35&quot;});return false;" type="submit"><span class="ui-button-text ui-c">No</span></button><script id="j_idt35_s" type="text/javascript">PrimeFaces.cw("CommandButton","widget_j_idt35",{id:"j_idt35"});</script></div></div>

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
