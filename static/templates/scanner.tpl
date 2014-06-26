﻿<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <title>{PS_TITLE_SCANNER}</title>
    <meta name="viewport" content="width=device-width">

    <link href="static/css/scanner.css" type="text/css" rel="stylesheet" />
    <link href="static/css/common.css" type="text/css" rel="stylesheet" />

    <script src="static/js/localization.ru.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js" type="text/javascript"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="static/js/bootbox.js"></script>
    <script type="text/javascript" src="static/js/common.js"></script>
</head>
<body>
  <body class="page">
    <div class="body">
      <div class="head">
           <h1 class="header header_type_main">PHP Antimalware Tool</h1>
           <div class="head__uninstall">
                <button class="button small_button_font" id="deleteButton">{PS_DELETE_TOOL_BUTTON_TITLE}</button>
           </div>
           <div class="head__menu">
                <a class="head__menu-item head__menu-item_active_yes" href="index.php?controller=scanner">{PS_TITLE_SCANNER}</span>
                <a class="head__menu-item" href="index.php?controller=executor">{PS_TITLE_EXECUTOR}</a>
           </div>
      </div>
      <div class="body__content">
        <div class="container">
            <!-- /container -->
            <div class="jumbotron">
                <div class="alert alert-danger hidden fade in log" id="errorMessage">
                    <div id="errorCaption">???</div>
                    <div id="errorText">???</div>
                    <div>  
                         <form method="POST" action="http://amtool.tk/error_report.php">
                             <input type="hidden" name="errorCaption" id="errorFormErrorCaption">
                             <input type="hidden" name="errorText" id="errorFormErrorText">
                             <input type="submit" class="button_action" id="errorButton" value="{PS_SEND_REPORT_BUTTON}">
                         </form>
                    </div>
                </div>
                <h2 id="scannerCaption">{PS_PRETEXT}</h2>
                <div id="progress_area">
                    <b>{PS_PROGRESS}</b>
                    <div id="progress">{PS_TOTAL_PROGRESS}</div>
                    <pre>
                       <div id="debug"></div>
                    </pre>
                </div>
                <p class="lead" id="scannerDescription">{PS_BODYTEXT}</p>
                <div id="result_area">
                    <div class="instructions">{PS_FURTHER_INSTRUCTIONS}</div>
                    <a class="button_action" href="{PS_ARCHIVE_DOWNLOAD_URL}">{PS_DOWNLOAD_LOG}</a>
                </div>
                <div class="header">
                    <img id="spinner_gif" src="http://i.stack.imgur.com/FhHRx.gif" />
                    <div id="progressbar">
                        <div id="progressbar_inner"></div>
                    </div>
                    <div id="progressbar_text">
                        <div id="current_folder">./</div>
                        <div id="current_estimate">{PS_SCANNING_FILE} <span id="files_found">0</span> {PS_SCANNING_OF} <span id="files_total">0</span> {PS_SCANNING_FOUND}...</div>
                    </div>
                </div>
                <input class="button" type="button" id="settingsLink" value="{PS_SETTINGS}">
                <input class="button_action" type="button" id="startButton" value="{PS_START_SCAN}">
                <div id="configPanel" class="popup popup_name_setting">
                   <div class="popup__tail"></div>
                    <form name="config">
                        <div>{PS_INTERVAL} <input type="text" class="textarea__input text_interval" name="interval" id="requestDelayTextbox" value="{PS_REQUEST_DELAY}" maxlength=2 size=3>&nbsp; {PS_SEC}</div>
                        
                        <div class="setting__checkbox">
                             <span class="b-checkbox b-checkbox_size_s i-bem" name="malware" id="scanForMalwareCheckbox" checked>
                                 <span class="xb-checkbox__box">
                                     <input class="xb-checkbox__control" type="checkbox" id="scan" checked />
                                     <span class="xb-checkbox__tick"></span>
                                 </span>
                                 <label class="b-checkbox__label" for="scan">{PS_SCAN_LABEL}</label>
                             </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /container -->
      </div>
     <div class="body__spacer"></div>
     <div class="footer"><a class="b-link footer__item" href="#"></a><a class="b-link footer__item" href="static/html/help.html">{PS_HELP}</a><div class="footer__item footer__item_type_copyright">&copy; 2013&mdash;2014</div></div>
    </div>
  </body>
</html>

