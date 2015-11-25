<h1 class="page-header">รายงานผล</h1>
<h2 class="sub-header">ยอดรับส่งรายเดือน</h2>
<div class="row">
    <div class="col-xs-6">
        <div class="form-group" id="form-sn">
            <label>S/N *</label>
            <img src="images/ajax-loader.gif" id="sn-loading" style="display: none"/>
            <span id="error" style="color: red"></span>
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-barcode"></span>
                </span>
                <input type="text" class="form-control" id="sn">
            </div>
        </div>

        <div class="form-group" id="form-brand">
            <label>ยี่ห้อ *</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-barcode"></span>
                </span>
                <input type="text" class="form-control" id="brand" disabled>
            </div>
        </div>

        <div class="form-group" id="form-model">
            <label>ชื่ออุปกรณ์ *</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-barcode"></span>
                </span>
                <input type="text" class="form-control" id="model" disabled>
            </div>
        </div>
    </div>

    <div class="col-xs-6">
        <div class="form-group" id="form-date">
            <label>วันที่รับคืน *</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                <input type="text" class="form-control" id="date">
            </div>
        </div>

        <div class="form-group" id="form-number">
            <label>เลขที่หนังสือรับ *</label>
            <img src="images/ajax-loader.gif" id="number-loading" style="display: none"/>
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-tag"></span>
                </span>
                <input type="text" class="form-control" id="number">
            </div>
        </div>

        <div class="form-group" id="form-location">
            <label>หมายเหตุ</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-pencil"></span>
                </span>
                <input type="text"class="form-control" id="note">
            </div>
        </div>
    </div>

    <div class="btn-group btn-outline">
        <button type="button" class="btn btn-warning" id="clear-button"><span class="glyphicon glyphicon-remove-circle"></span> ล้างฟอร์ม</button>
    </div>

    <div class="btn-group btn-outline">
        <button type="button" class="btn btn-success" id="submit-button"><span class="glyphicon glyphicon-save"></span> รับคืน</button>
    </div>

</div>


<script type="text/javascript">


</script>
