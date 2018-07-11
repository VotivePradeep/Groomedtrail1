

	  
	  
	  <div class="static-content-wrapper">
                    <div class="static-content">
                        <div class="page-content">
                            
                            <div class="page-heading">
                                <h1>Form Validation</h1>
                                
                            </div>
                            <div class="container-fluid">
                                
<div data-widget-group="group1">
	<div class="row">
	  

	    <div class="col-xs-12">
		    <div class="alert alert-info">
		    <h3>Parsley <small>Form Validation</small></h3>
				 <p>The goal of web form validation is to ensure that the user provided necessary and properly formatted information needed to successfully complete an operation. With Outline, you can have front-end, UX-aware form validation without writing a single line of code! Click Submit for the validation to take in effect.</p>
			</div>

	        <div id="validate-form" data-parsley-validate>
	            <div class="panel-heading">
	            	<h2>Form Validation</h2>
	            	<div class="panel-ctrls" data-actions-container="" data-action-collapse='{"target": ".panel-body, .panel-footer"}'></div>
	            </div>
	            <div class="panel-body">
	                <form class="form-horizontal row-border">
	                    <div class="form-group">
	                        <label class="col-sm-3 control-label">Required Field</label>
	                        <div class="col-sm-6">
	                            <input type="text" placeholder="Required Field" required class="form-control">
	                        </div>
	                    </div>
						<div class="form-group">
						    <label class="col-sm-3 control-label">Min-length</label>
						    <div class="col-sm-6">
						        <input type="text" data-parsley-minlength="6" placeholder="At least 6 characters" required class="form-control">
						    </div>
						</div>
						<div class="form-group">
						    <label class="col-sm-3 control-label">Max-legnth</label>
						    <div class="col-sm-6">
						        <input type="text" data-parsley-maxlength="6" placeholder="At most 6 characters" required class="form-control">
						    </div>
						</div>
						<div class="form-group">
						    <label class="col-sm-3 control-label">Range length</label>
						    <div class="col-sm-6">
						        <input type="text" data-parsley-range="[5,10]" placeholder="Between 5 and 10 characters" required class="form-control">
						    </div>
						</div>
						<div class="form-group">
						    <label class="col-sm-3 control-label">RegExp</label>
						    <div class="col-sm-6">
						        <input type="text" data-parsley-pattern="#[A-Fa-f0-9]{6}" placeholder="Hexadecimal Color Code" required class="form-control">
						    </div>
						</div>

						<div class="form-group">
						    <label class="col-sm-3 control-label">Email</label>
						    <div class="col-sm-6">
						        <input type="text" data-parsley-type="email" placeholder="Email address" required class="form-control">
						    </div>
						</div>
						<div class="form-group">
						    <label class="col-sm-3 control-label">URL</label>
						    <div class="col-sm-6">
						        <input type="text" data-parsley-type="url" placeholder="URL address" required class="form-control">
						    </div>
						</div>
						<div class="form-group">
						    <label class="col-sm-3 control-label">Digits</label>
						    <div class="col-sm-6">
						        <input type="text" data-parsley-type="digits" placeholder="Digits only" required class="form-control">
						    </div>
						</div>
						<div class="form-group">
						    <label class="col-sm-3 control-label">Alphanum</label>
						    <div class="col-sm-6">
						        <input type="text" data-parsley-type="alphanum" placeholder="Alphanumeric only" required class="form-control">
						    </div>
						</div>
						<div class="form-group">
						    <label class="col-sm-3 control-label">Password</label>
						    <div class="col-sm-6">
						        <input type="text" id="ps1" required class="form-control">
						    </div>
						</div>
						<div class="form-group">
						    <label class="col-sm-3 control-label">Repeat Password</label>
						    <div class="col-sm-6">
						        <input type="text" data-parsley-equalto="#ps1" required class="form-control">
						    </div>
						</div>
						<div class="form-group">
						    <label class="col-sm-3 control-label">Checkbox</label>
						    <div class="col-sm-6">
						        <div class="checkbox">
						          <label>
						            <input type="checkbox" required name="terms">
						            Accept Terms &amp; Conditions
						          </label>
								
						      </div>
						  </div>
						</div>
	                    
	               </form> 
	            </div>
	            <div class="panel-footer">
	               <div class="form-group">
	                    <div class="col-sm-6 col-sm-offset-3">
	                        <div class="btn-toolbar">
	                        	<button class="btn btn-default submit">Submit</button>
	                            <button class="btn btn-default">Cancel</button>
	                        </div>
	                    </div>
	                </div> 
	            </div>
	        
			</div>
	   

	   </div>
	</div>
</div>

                            </div> <!-- .container-fluid -->
                        </div> <!-- #page-content -->
                    </div>
                    
	  
	  


   
   
     
