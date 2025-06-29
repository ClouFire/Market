<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Get In Touch</h2>
            </div>
            <div class="col-md-7">

                <form action="<?= baseUrl('/contact') ?>" method="post">
                    <?= getCsrfField(); ?>
                    <div class="p-3 p-lg-5 border">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="c_fname" class="text-black">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_fname" name="c_fname" required>
                            </div>
                            <div class="col-md-6">
                                <label for="c_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_lname" name="c_lname" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_email" class="text-black">Email <span class="text-danger">*</span></label>
                                <input name="c_email" type="email" class="form-control <?= getValidationClass('c_email'); ?>" id="c_email" placeholder="name@example.com" required>
                                <?= get_errors('email');?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_subject" class="text-black">Subject </label>
                                <input type="text" class="form-control" id="c_subject" name="c_subject">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">

                                <label for="c_message" class="text-black">Message <span class="text-danger">*</span></label>
                                <textarea name="c_message" id="c_message" cols="30" rows="7" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <input type="submit" class="btn btn-primary btn-lg btn-block" value="Send Message">
                            </div>
                        </div>
                    </div>
                </form>
                <?php
                session()->remove('form_errors');
                session()->remove('form_data');
                ?>
            </div>
            <div class="col-md-5 ml-auto">
                <div class="p-4 border mb-3">
                    <span class="d-block text-primary h6 text-uppercase">New York</span>
                    <p class="mb-0">203 Fake St. Mountain View, San Francisco, California, USA</p>
                </div>
                <div class="p-4 border mb-3">
                    <span class="d-block text-primary h6 text-uppercase">London</span>
                    <p class="mb-0">203 Fake St. Mountain View, San Francisco, California, USA</p>
                </div>
                <div class="p-4 border mb-3">
                    <span class="d-block text-primary h6 text-uppercase">Canada</span>
                    <p class="mb-0">203 Fake St. Mountain View, San Francisco, California, USA</p>
                </div>

            </div>
        </div>
    </div>
</div>