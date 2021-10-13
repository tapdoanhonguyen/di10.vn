<!-- BEGIN: main -->
<div class="well">
    <form action="{NV_BASE_ADMINURL}index.php" method="get">
        <input type="hidden" name="{NV_NAME_VARIABLE}" value="{MODULE_NAME}" />
        <input type="hidden" name="{NV_OP_VARIABLE}" value="{OP}" />

        <div class="row">
            <div class="col-xs-12 col-md-6">
                <div class="form-group">
                    <select class="form-control" name="productid" id="productid">
                        <option value="0"> -- {LANG.discount_product} -- </option>
                        <!-- BEGIN: sl_productid -->
                        <option value="{PRODUCT.id}" {PRODUCT.sl} >{PRODUCT.title}</option>
                        <!-- END: sl_productid -->
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-md-8">
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="{LANG.search}" />&nbsp;
                    <button class="btn btn-success" id="checkdmca">Check Status</button>
                </div>
            </div>
        </div>
        <input type="hidden" name="checkss" value="{NV_CHECK_SESSION}" />
        <label><em>{LANG.search_note}</em></label>
    </form>
    <script type="text/javascript">
        $('#checkdmca').click(function(){
            var data_item = '{data_item}';
            get_link_data( data_item );
            return false;

        })
        function get_link_data( data_item ){
            if( $('#item' + data_item ).length){
                var elment_html = $('#item' + data_item );
                var smsid =  $('#item' + data_item ).attr('data_smsid');
                var id =  $('#item' + data_item ).attr('data_id');
                var status =  $('#item' + data_item ).attr('data_status');
                if( status != 5 ){
                    check_sms_status(smsid, id, data_item, elment_html);
                }else{
                    data_item++;
                    get_link_data( data_item );
                }

            }
        }
        function check_sms_status(smsid, id, data_item, elment_html){
            $(elment_html).find('.status').html('<img src="'+ nv_base_siteurl +'assets/images/load_bar.gif" />');
            $.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '={OP}&nocache=' + new Date().getTime(), 'checkstatus=1&id=' + id + '&smsid=' + smsid + '&data_item=' + data_item, function(res) {
                res = res.split('_');
                $(elment_html).find('.status').html(res[0]);
                get_link_data( res[1] );
            });
        }
    </script>
</div>
<form class="form-inline" action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>{LANG.content}</th>
                <th>{LANG.receiver}</th>
                <th>{LANG.timesend}</th>
                <th>{LANG.timesent}</th>
                <th>{LANG.status}</th>
            </tr>
            </thead>
            <!-- BEGIN: generate_page -->
            <tfoot>
            <tr>
                <td colspan="6" class="text-center">{NV_GENERATE_PAGE}</td>
            </tr>
            </tfoot>
            <!-- END: generate_page -->
            <tbody>
            <!-- BEGIN: loop -->
            <tr id="item{VIEW.stt}" data_item="{VIEW.stt}" data_id="{VIEW.id}" data_smsid="{VIEW.smsid}" data_status="{VIEW.status}">
                <td> {VIEW.content} </td>
                <td> {VIEW.mobile} </td>
                <td> {VIEW.timesend} </td>
                <td> {VIEW.timesent} </td>
                <td> <span class="status">&nbsp;{VIEW.status_text} </span></td>
            </tr>
            <!-- END: loop -->
            </tbody>
        </table>
    </div>
</form>
<!-- END: main -->