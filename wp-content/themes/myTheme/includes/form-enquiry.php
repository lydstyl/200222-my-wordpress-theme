<form id="enquiry">
  <h2>Send an enquiry about <?= the_title() ?></h2>

  <div class="form-group row">
    <div class="col-lg-6">
      <input type="text" name="fname" placeholder="First Name" class="form-control" required>
    </div>
    
    <div class="col-lg-6">
      <input type="text" name="lname" placeholder="Last Name" class="form-control" required>
    </div>
  </div>

  <div class="form-group row">
    <div class="col-lg-6">
      <input type="text" name="email" placeholder="Email Address" class="form-control" required>
    </div>

    <div class="col-lg-6">
      <input type="tel" name="phone" placeholder="Phone"  class="form-control" required>
    </div>
  </div>

  <div class="form-group">
    <textarea name="enquiry" class="form-control" placeholder="Your Enquiry" required></textarea>
  </div>

  <div class="form-group">
    <button type="submit" class="btn btn-success btn-block">Send your enquiry</button>
  </div>
</form>

<script>
  (function ($) {
    $('#enquiry').submit(function(event){
      event.preventDefault();

      var endpoint = '<?= admin_url('admin-ajax.php') ?>'

      var form = $('#enquiry').serialize();

      var formdata = new FormData;

      formdata.append('action', 'enquiry'); // WP will try to find a function named 'enquiry'
      formdata.append('enquiry', form);

      console.log(formdata);

      $.ajax(endpoint, {
        type: 'POST',
        data: formdata,
        processData: false,
        contentType: false, // off because we use FormData
        success: function(res){
          alert(res.data);
          console.log(res.data);
        },
        error: function(err){
          alert(err);
          console.log(err);
        }
      })
    })
  })(jQuery)
</script>