<!-- BEGIN: main -->
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<!-- BEGIN: error -->
<div class="alert alert-warning">{ERROR}</div>
<!-- END: error -->
<form class="form-horizontal" action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
    <input type="hidden" name="id" value="{ROW.id}" />
    <input type="hidden" name="sid" value="{sid}" />
    <div class="row">
        <div class="col-xs-24 col-sm-19">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <label><strong>{LANG.content}</strong></label>
                        <textarea class="form-control" style="width:100%; height:150px" name="content">{ROW.content}</textarea>
                        <span style="margin-top: 10px; display: block; font-weight: bold">{LANG.content_note}</span>
                        <blockquote class="personal">
                            <div class="row">
                                <!-- BEGIN: personal -->
                                <div class="col-xs-24 col-sm-12">
                                    <label>{PERSONAL.index}</label> {PERSONAL.value}
                                </div>
                                <!-- END: personal -->
                            </div>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-24 col-sm-5">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {LANG.typysend}&nbsp;&nbsp;<span data-toggle="tooltip" data-placement="top" title="" data-original-title="{LANG.typetime_note}"><em class="fa fa-info-circle fa-pointer text-info">&nbsp;</em></span>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div>
                            <!-- BEGIN: sendtype -->
                            <label><input class="sendtype" type="radio" name="sendtype" value="{TYPESEND.index}" {TYPESEND.checked} />{TYPESEND.value}</label>&nbsp;
                            <!-- END: sendtype -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default form-inline">
                <div class="panel-heading">{LANG.timesend}</div>
                <div class="panel-body">
                    <div class="form-group">
                        {LANG.timesend_day}&nbsp;<input class="form-control w50" type="text" name="daysend" value="{ROW.daysend}" />&nbsp;{LANG.day}
                    </div>
                    <div class="form-group" style="width: 100%;padding-top: 10px">
                        {LANG.timesend_hour}&nbsp;
                        <select name="hoursend" class="form-control w100">
                            <!-- BEGIN: hour -->
                            <option value="{HOUR.index}"{HOUR.selected}>{HOUR.index}</option>
                            <!-- END: hour -->
                        </select>
                        &nbsp;{LANG.hour}
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="form-group text-center">
        <input class="btn btn-warning loading" name="draft" type="submit" value="{LANG.adddraft}" />
        <input class="btn btn-primary loading" name="submit" type="submit" value="{LANG.campaign_add}" />
    </div>
</form>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<!-- END: main -->