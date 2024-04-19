<!-- verify rfid -->
<div class="modal fade" id="verify-rfid-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header"> 
              <img src="../shared/images/rfid.png" class="btn-add" alt="add-user">
                <h5 class="modal-title">Verify RFID Tag</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form  method="POST" id="verify-rfid-form" name ="verify-rfid-form">
                    <div class="col mb-2">
                        <label class="form-label">Verification Code</label>
                        <input type="text" class="form-control" id="verify_code" name="verify_code">
                    </div>
                    <div class="col mb-2">
                        <label class="form-label">RFID Tag</label>
                        <input type="text" class="form-control" id="verify_tag" name="verify_tag">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Verify</button>
            </div>
            </form>
        </div>
    </div>
</div> 