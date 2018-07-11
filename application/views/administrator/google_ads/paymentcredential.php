<?php $this->load->view('administrator/include/left_sidebar'); ?>
 <style type="text/css">
     .form-group {
    overflow: hidden;
}
label.col-sm-3.control-label.cms-label {
    text-align: right;
    margin-bottom: 10px;
}
 </style>
<div class="warper container-fluid">

    <div class="row">

        <div class="col-md-12">

            <div class="panel panel-default add-user-sec">
            <div class="panel-heading">Payment  Credential </div>

                <div class="panel-body">
                 <div id="responseMsg"></div>

                    <form class="form-horizontal" method="post" action="<?php echo base_url()."administrator/paymentcredential" ?>">
                        <div class="form-group">
                            <label class="col-sm-3 control-label cms-label">Payment Mode</label>
                            <div class="col-sm-8">
                               <select name="config_type" id="config_type" class="form-control">
                                   <option value="">Select Payment Mode</option>
                                   <option value="Sendbox" <?php if(isset($paypal_credential->config_type)){ if($paypal_credential->config_type == "Sendbox"){ echo "selected"; } }  ?>>Test</option>
                                   <option value="Live" <?php if(isset($paypal_credential->config_type)){ if($paypal_credential->config_type == "Live"){ echo "selected"; } }  ?>>Live</option>
                                   
                               </select>
                               <label id="config_type-error" class="error" for="config_type"><?php echo form_error('config_type');?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label cms-label">Paypal Email</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="paypal_email" id="paypal_email" placeholder="Enter paypal email" value="<?php if(isset($paypal_credential->paypal_email)){echo $paypal_credential->paypal_email; } ?>" />
                                <label id="paypal_email-error" class="error" for="paypal_email"><?php echo form_error('paypal_email');?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label cms-label">Paypal Default Currency</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="paypal_default_currency" id="paypal_default_currency" placeholder="Enter paypal default currency" value="<?php if(isset($paypal_credential->paypal_default_currency)){echo $paypal_credential->paypal_default_currency; } ?>" readonly />
                                <label id="paypal_email-error" class="error" for="paypal_default_currency"><?php echo form_error('paypal_default_currency');?></label>
                            </div>
                        </div>
                        <hr class="dotted">
                        <div class="form-group buton-edit">
                            <div class="col-sm-9 col-sm-offset-3">
                                <button  type="submit" class="btn btn-primary" name="signup">Update</button>
                            </div>
                        </div>
                    </form>
                
                
                </div>
            </div>
        </div>
    </div>       

</div>
