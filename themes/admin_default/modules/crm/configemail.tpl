<!-- BEGIN: main -->
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<!-- BEGIN: error -->
<div class="alert alert-warning">{ERROR}</div>
<!-- END: error -->
<form class="form-horizontal" action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
    <input type="hidden" name="id" value="{ROW.id}" />
    <input type="hidden" name="sid" value="{sid}" />
    <div class="row">
        <div class="col-xs-24 col-sm-24">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group" id="title">
                        <label><strong>{LANG.title_mail}</strong></label> <input type="text" class="form-control" name="title" value="{ROW.title}" placeholder="{LANG.title_mail}">
                    </div>
                    <div class="form-group">
                        <label><strong>{LANG.content_mail}</strong></label>
                        <div>{ROW.content}</div>
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
    </div>
    <div class="form-group text-center">
        <input class="btn btn-warning loading" name="draft" type="submit" value="{LANG.adddraft}" />
        <input class="btn btn-primary loading" name="submit" type="submit" value="{LANG.campaign_add}" />
    </div>
</form>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript">
    if( $('input[name=sendtype]:checked').val() == 1 ){
        $('#title').hide();
    }else{
        $('#title').show();
    }
    //<![CDATA[
    $('input.sendtype').change(function() {
        if ($(this).val() == 1) {
            $('#title').hide();
        } else{
            $('#title').show();
        }
    });
    //]]>
</script>
<!-- END: main -->