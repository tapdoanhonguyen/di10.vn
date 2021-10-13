<!-- BEGIN: main -->
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js?t=2"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/vi.js?t=2"></script>
<link rel="stylesheet" href="/assets/js/select2/select2.min.css?t=2">
<script>
    $(document).ready(function () {
        oTable = $('#PQData').dataTable({
            "aaSorting": [[1, "desc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tất cả"]],
            "iDisplayLength": 10,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': script_name + '?' + nv_name_variable + '=storehouse&' + nv_fc_variable + '=ajax&mod=getQuantityAlerts',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "token",
                    "value": "488d3f65c75994c5f3b7971127f1ed3d"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            "aoColumns": [{
                "bSortable": false,
                "mRender": img_hl
            }, null, null, {"mRender": formatQuantity}, {"mRender": formatQuantity}],
        }).fnSetFilteringDelay().dtFilter([
            {column_number: 1, filter_default_label: "[Mã sản phẩm]", filter_type: "text", data: []},
            {column_number: 2, filter_default_label: "[Tên sản phẩm]", filter_type: "text", data: []},
            {column_number: 3, filter_default_label: "[Số lượng]", filter_type: "text", data: []},
            {column_number: 4, filter_default_label: "[Số lượng cảnh báo]", filter_type: "text", data: []},
        ], "footer");
    });
</script>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i
                class="fa-fw fa fa-calendar-o"></i>Cảnh báo số lượng SP (Tất cả kho hàng)        </h2>

        <div class="box-icon">
            <ul class="btn-tasks">
                 <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="icon fa fa-building-o tip" data-placement="left" title="Kho hàng"></i>
                        </a>
                        <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                            <li>
                                <a href="">
                                    <i class="fa fa-building-o"></i> Tất cả kho hàng                                </a>
                            </li>
                            <li class="divider"></li>
                            <!-- BEGIN: warehouse -->
                            	<li ><a href=""><i class="fa fa-building"></i>Warehouse 1</a></li>
                            <!-- END: warehouse -->
                         </ul>
                 </li>
             </ul>
        </div>
        <div class="box-icon">
        </div>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-24">

                <p class="introtext">Vui lòng sử dụng bảng dưới đây để điều hướng hoặc lọc các kết quả. Bạn có thể tải về bảng như excel và pdf.</p>

                <div class="table-responsive">
                    <table id="PQData" cellpadding="0" cellspacing="0" border="0"
                           class="table table-bordered table-condensed table-hover table-striped dfTable reports-table">
                        <thead>
                        <tr class="active">
                            <th style="min-width:40px; width: 40px; text-align: center;">Ảnh</th>
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Số lượng cảnh báo</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="5" class="dataTables_empty">Đang tải dữ liệu từ máy chủ</td>
                        </tr>
                        </tbody>
                        <tfoot class="dtFilter">
                        <tr class="active">
                            <th style="min-width:40px; width: 40px; text-align: center;">Ảnh</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: main -->