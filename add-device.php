<h2 class="sub-header">อุปกรณ์</h2>
<div class="row">
    <div class="col-xs-6">
        <div class="form-group" id="form-brand">
            <label>ยี่ห้อ *</label>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle form-control" type="button" id="brand" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="width: 100%">
                    <text>เลือกยี่ห้อ</text>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="brand-dropdown" style="width: 100%">
                    <li><a href="#">OPNET</a></li>
                    <li><a href="#">ERICSSON</a></li>
                    <li><a href="#">HUAWEI</a></li>
                    <li><a href="#">FORTH</a></li>
                    <li><a href="#">ZTE</a></li>
                    <li><a href="#">KEMINE</a></li>
                    <li><a href="#">ZYXEL</a></li>
                </ul>
            </div>
        </div>

        <div class="form-group" id="form-model">
            <label>ชื่ออุปกรณ์ *</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-barcode"></span>
                </span>
                <input type="text" class="form-control" id="model">
            </div>
        </div>

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

        <div class="form-group" id="form-type">
            <label>ประเภทการใช้งาน *</label>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle form-control" type="button" id="type" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="width: 100%">
                    <text>เลือกประเภท</text>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="type-dropdown" style="width: 100%">
                    <li><a href="#">เลขหมาย</a></li>
                    <li><a href="#">CPU</a></li>
                    <li><a href="#">POWER</a></li>
                    <li><a href="#">TSW</a></li>
                    <li><a href="#">EMRP</a></li>
                    <li><a href="#">SLCT</a></li>
                    <li><a href="#">RP</a></li>
                    <li><a href="#">DCI</a></li>
                    <li><a href="#">CONTROL</a></li>
                    <li><a href="#">ADSL</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-xs-6">
        <div class="form-group" id="form-date">
            <label>วันที่นำเข้า *</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                <input type="text" class="form-control" id="date">
            </div>
            <div class="filthypillow" id="calendar"></div>
        </div>

        <div class="form-group">
            <label>หมายเหตุ</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-pencil"></span>
                </span>
                <input type="text" class="form-control" id="note">
            </div>
        </div>
    </div>

    <div class="btn-group">
        <button type="button" class="btn btn-warning" ID="clear-button">Clear</button>
    </div>

    <div class="btn-group">
        <button type="button" class="btn btn-success" id="submit-button">Submit</button>
    </div>


</div>

<script type="text/javascript">


</script>
