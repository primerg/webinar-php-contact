<h1>Contact us</h1>

<?php if (isset($message_type)): ?>
<div class="<?php echo $message_type ?>">
<?php echo $message ?>
</div>
<?php endif; ?>

<form id="contactForm" method="post" action="<?php url('/login') ?>" >
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email" name="email"  placeholder="Email">
  </div>
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" minlength="2"  name="name" id="name" placeholder="Your name">
  </div>
  <div class="form-group">
    <label for="message">Message</label>
    <textarea name="message" class="form-control"  rows="6" ></textarea>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>

<style type="text/css">
  .error {
    color: red;
  }

  .success {
    color: green;
  }
</style>