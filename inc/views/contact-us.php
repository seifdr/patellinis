<div class="modal fade" id="contactUsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!--data-dismiss="modal"-->
        <button type="button" class="close dismissMe" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="message-text" class="control-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <!--data-dismiss="modal"-->
        <button type="button" class="btn btn-default dismissMe">Close</button>
        <button type="button" class="btn btn-primary" id="sendMsg">Send message</button>
      </div>
    </div>
  </div>
</div>