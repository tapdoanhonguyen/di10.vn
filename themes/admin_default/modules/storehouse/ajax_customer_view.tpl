<!-- BEGIN: main -->
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        <i class="fa fa-2x">&times;</i>
    </button>
    <button type="button" class="btn btn-xs btn-default no-print pull-right" style="margin-right:15px;" onclick="window.print();">
        <i class="fa fa-print"></i> {LANG.print}            </button>
    <h4 class="modal-title" id="myModalLabel">{ROW.text}</h4>
</div>
<div class="modal-body">
    <div class="table-responsive">
        <table class="table table-striped table-bordered" style="margin-bottom:0;">
            <tbody>
            <tr>
                <td><strong>{LANG.company}</strong></td>
                <td>{ROW.company}</strong></td>
            </tr>
            <tr>
                <td><strong>{LANG.customer_name}</strong></td>
                <td>{ROW.name}</strong></td>
            </tr>
            <tr>
                <td><strong>{LANG.groups_customer}</strong></td>
                <td>{ROW.group_name}</strong></td>
            </tr>
            <tr>
                <td><strong>{LANG.tax_code}</strong></td>
                <td></strong></td>
            </tr>

            <tr>
                <td><strong>{LANG.email}</strong></td>
                <td>{ROW.email}</strong></td>
            </tr>
            <tr>
                <td><strong>{LANG.phone}</strong></td>
                <td>{ROW.phone}</strong></td>
            </tr>
            <tr>
                <td><strong>{LANG.address}</strong></td>
                <td>{ROW.address}</strong></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="modal-footer no-print">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{LANG.close}</button>
                                            <a href="/admin/index.php?language=vi&nv=storehouse&op=ajax&mod=customers_edit&customer_id={ROW.id}" data-toggle="modal" data-target="#myModal2C" class="btn btn-primary">{LANG.edit_customer}</a>
                    </div>
    <div class="clearfix"></div>
</div>
<!-- END: main -->