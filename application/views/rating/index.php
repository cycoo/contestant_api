<div class="container">
  <h2>Rate Contestant</h2>  

  <?php
  	if(!empty($error)){
  		$error=$error;	
  	}else{
  		$error=$this->session->flashdata('error');
  	}
  	
  	$success=$this->session->flashdata('success');
  	if(!empty($error)){
  		?>
  		<div class="alert alert-danger">
  			<strong>Error!</strong><?= $error?>.
  		</div>
  		<?php
  	}
  	if(!empty($success)){
  		?>
  		<div class="alert alert-success">
  			<strong>Success!</strong><?= $success?>.
  		</div>
  		<?php
  	}
  ?>

  <form method="post" action="<?= site_url('Rating')?>">
                  <div class="form-group">
                    <div class="col-sm-4">From Date:
                        <input type="text" name="start_date" class="form-control start_date" value="<?= set_value('start_date')?>">
                    </div>

                     <div class="col-sm-4">To Date:
                        <input type="text" name="end_date" class="form-control end_date" value="<?= set_value('end_date')?>">
                    </div>                         

                    <div class="col-sm-4">
                      <button type="submit" class="btn btn-success">Search</button>
                    </div> 
                  </div>
  </form>
  <legend></legend>

  <table class="table">
    <thead>
      <tr>
        <th>Full Name</th>
        <th>Date Of Birth</th>
        <th>District</th>
        <th>Average Rating</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    	if(!empty($contestants)){
    		foreach($contestants as $detail){
    			?>
    		<tr>
		        <td><?= $detail['firstname']." ".$detail['lastname']?></td>
		        <td><?= $detail['dob']?></td>
		        <td><?= $detail['district']?></td>
		        <td><?= (empty($rating[$detail['contestant_id']]) )?0:round($rating[$detail['contestant_id']],1)?></td>
		        <td>
		        <a data-toggle="modal" data-target="#contestant<?=$detail['contestant_id']?>" class="btn btn-primary">Rate This Contestant</a>
		        </td>
		    </tr>

		    <!-- Modal edit content-->
		    <div class="modal fade" id="contestant<?=$detail['contestant_id']?>" role="dialog">
    			<div class="modal-dialog">
			      <div class="modal-content">
			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          <h4 class="modal-title">Contestant Rating Form</h4>
			        </div>
			        <div class="modal-body">
			            <form method="post" action="<?= site_url('Rating/rate/'.$detail['contestant_id'])?>" enctype="multipart/form-data">
    						  <div class="form-group">
    						    <label for="firstname">Contestant Name: &nbsp;</label><?= $detail['firstname']." ".$detail['lastname']?>
    						    <input type="text" name="contestant" value="<?= $detail['firstname']." ".$detail['lastname']?>" hidden>
    						  </div>						 
    						  <div class="form-group">
    						    <label>Rate:</label>
    						    <?php
    						    	for($i=1;$i<=5;$i++){
    						    		?>
    						    		<label class="radio-inline">
    								      <input type="radio" name="rating" value="<?= $i ?>" ><?= $i ?>
    								    </label>
    						    		<?php
    						    	}
    						    ?>	    
    						  </div>	

    						  <div class="form-group">
    						    <button type="submit" class="btn btn-success">Save</button>
    				          	<a href="" class="btn btn-danger">Close</a>
    						  </div>
						  </form>
			        </div>
			      </div>
			    </div>
			</div>
    			<?php
    		}
    	}
    ?>
    </tbody>
  </table>
<!-- <script type="text/javascript">
  $('.start_date').datepicker({
    format: 'mm/dd/yyyy'
  });

  $('.end_date').datepicker({
    format: 'mm/dd/yyyy'
  });

</script> -->


<script>
  $(document).ready(function () {
    var daysToAdd = 1;
    $(".start_date").datepicker({
      showButtonPanel: true,
      onSelect: function (selected) {
        var dtMax = new Date(selected);
        dtMax.setDate(dtMax.getDate() + daysToAdd);
        var dd = dtMax.getDate();
        var mm = dtMax.getMonth() + 1;
        var y = dtMax.getFullYear();
        var dtFormatted = mm + '/'+ dd + '/'+ y;

        $(".end_date").val(dtFormatted);

        $(".end_date").datepicker("option", "minDate", dtFormatted);
      }
    });

    $('.end_date').datepicker({
    format: 'mm/dd/yyyy'
  });
  });
</script>

