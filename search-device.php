<h2 class="sub-header">ค้นหาอุปกรณ์</h2>
<div class="row">
    <div class="col-xs-6">
        <div class="form-group" id="form-brand">
            <label>ยี่ห้อ</label>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="brand" data-toggle="dropdown" style="width: 100%">
                    <text>All</text>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="brand-dropdown" style="width: 100%">
                    <li><a href="#">All</a></li>
                </ul>
            </div>
        </div>

        <div class="form-group" id="form-brand">
            <label>ชื่ออุปกรณ์</label>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="model" data-toggle="dropdown" style="width: 100%">
                    <text>All</text>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="model-dropdown" style="width: 100%">
                    <li><a href="#">All</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-xs-6">
        <div class="form-group" id="form-brand">
            <label>ประเภทการใช้งาน</label>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="type" data-toggle="dropdown" style="width: 100%">
                    <text>All</text>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="type-dropdown" style="width: 100%">
                    <li><a href="#">All</a></li>
                </ul>
            </div>
        </div>

        <div class="form-group" id="form-brand">
            <label>สถานะ</label>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="status" data-toggle="dropdown" style="width: 100%">
                    <text>All</text>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="status-dropdown" style="width: 100%">
                    <li><a href="#">All</a></li>
                    <li><a href="#">In stock</a></li>
                    <li><a href="#">Claiming</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="btn-group btn-outline">
        <button type="button" class="btn btn-warning" id="clear-button"><span class="glyphicon glyphicon-remove-circle"></span> ล้างฟอร์ม</button>
    </div>

    <div class="btn-group btn-outline">
        <button type="button" class="btn btn-info" id="search-button"><span class="glyphicon glyphicon-search"></span> ค้นหา</button>
    </div>

    <div class="panel panel-default">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ยี่ห้อ</th>
                    <th>ชื่ออุปกรณ์</th>
                    <th>S/N</th>
                    <th>ประเภทการใช้งาน</th>
                    <th>สถานะ</th>
                    <th>หมายเหตุ</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="table-body">
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="detail-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">New message</h4>
                </div>
                <div class="modal-body">
                    <label class="control-label" id="brand">Brand:</label>
                    <label class="control-label" id="model">Model:</label>
                    <label class="control-label" id="sn">S/N:</label>
                    <label class="control-label" id="type">Type:</label>
                    <label class="control-label" id="date-added">Date added:</label>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>วันที่</th>
                                <th>เลขที่หนังสือ</th>
                                <th>สถานที่ส่งเคลม</th>
                                <th>ประเภท</th>
                                <th>หมายเหตุ</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="table-body-modal">

                        </tbody>
                    </table>

                    <div class="btn-group btn-outline">
                        <button type="button" class="btn btn-info" id="edit-button"><span class="glyphicon glyphicon-pencil"></span> แก้ไขรายละเอียดบอร์ด</button>
                    </div>

                    <div class="btn-group btn-outline">
                        <a href="#" data-toggle="modal" data-target="#confirm-modal" id="ahref">
                            <button type="button" class="btn btn-danger" id="broken-button"><span class="glyphicon glyphicon-trash"></span> แจ้งเสียโดยชิ้นเชิง</button>
                        </a>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    ยืนยันการแจ้งเสียโดยสิ้นเชิง
                </div>
                <div class="modal-body">
                    หมายเลข  จะไม่สามารถนำกลับมาใช้ได้อีก
                    ยืนยัน?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                    <a class="btn btn-danger btn-ok">ยืนยัน</a>
                </div>
            </div>
        </div>
    </div>
</div>





</div>

<script type="text/javascript">


</script>
