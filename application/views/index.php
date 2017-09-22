<div class="container">
  <h2>Contestant</h2>  

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

  <table class="table">
    <thead>
      <tr>
        <th>Full Name</th>
        <th>Date Of Birth</th>
        <th>District</th>
        <th>Gender</th>
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
		        <td><?= $detail['gender']?></td>
		        <td>
		        <a data-toggle="modal" data-target="#contestant<?=$detail['contestant_id']?>" class="btn btn-primary">Edit</a>
		        &nbsp;
		        <a data-toggle="modal" data-target="#delete<?=$detail['contestant_id']?>" class="btn btn-danger">Delete</a></td>
		    </tr>

		    <!-- Modal edit content-->
		    <div class="modal fade" id="contestant<?=$detail['contestant_id']?>" role="dialog">
    			<div class="modal-dialog">
			      <div class="modal-content">
			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          <h4 class="modal-title">Contestant Form</h4>
			        </div>
			        <div class="modal-body">
			            <form method="post" action="<?= site_url('Contestant/contestant/'.$detail['contestant_id'])?>" enctype="multipart/form-data">
						  <div class="form-group">
						    <label for="firstname">First Name</label>
						    <input data-validation="firstname" type="firstname" class="form-control" name="firstname" id="firstname" value="<?= $detail['firstname']?>">
						  </div>
						  <div class="form-group">
						    <label for="lastname">Last Name</label>
						    <input data-validation="lastname" type="text" class="form-control" name="lastname" id="lastname" value="<?= $detail['lastname']?>">
						  </div>

						  <div class="form-group">
						    <label for="dob">Date Of Birth</label>		    
						    <input data-validation="dob" type="text" class="form-control dob" name="dob" data-provide="datepicker" 
						    value="<?= date('m/d/Y',strtotime($detail['dob']))?>">
						  </div>

						  <div class="isActive">
						    <label><input type="checkbox" name="isActive" <?= ($detail['is_active']==1)?'checked':''?>>Is Active</label>
						  </div>

						  <div class="form-group">
						    <label for="district">District</label>
						    <select data-validation="required" type="text" class="form-control" name="district" id="district">
						    <?php 
						    	if(!empty($districts)){

						    	}foreach ($districts as $district) {
						    		?>
						    		<option value="<?= $district['id']?>" <?= ($district['id']==$detail['district_id'])?'selected':'';?>><?= $district['name']?></option>
						    		<?php
						    	}
						    ?>
						    </select>
						  </div>
						  <div class="form-group">
						    <label>Gender:</label>
						    <label class="radio-inline">
						      <input type="radio" name="gender" value="Male" <?= ($detail['gender']=='Male')?'checked':''?>>Male
						    </label>
						    <label class="radio-inline">
						      <input type="radio" name="gender" value="Female" <?= ($detail['gender']=='Female')?'checked':''?>>Female
						    </label>			    
						  </div>

						  <div class="form-group">
						    <label for="photo">Photo</label>
						    <span id="remove<?= $detail['contestant_id']?>">
						    <?php
							     if(!empty($detail['address'])){
							     	?>
							     	<img width="100" height="100" src="<?= base_url().'uploads/contestant/'.$detail['photo_url']?>">
							     	<a class="btn btn-default" onclick="remove(this)" data-id="<?= $detail['contestant_id']?>">Remove</a>
							     	<?php
							     }
						     ?>
						    </span>
						    <span  id="photo<?= $detail['contestant_id']?>" hidden>
						    	<input type="file" class="form-control" name="photo"  >
						    </span>
						  </div>

						  <div class="form-group">
						    <label for="address">Address</label>
						    <textarea data-validation="address" class="form-control" name="address" id="address" ><?= $detail['address']?></textarea> 
						  </div>	

						  <div class="form-group">
						    <button type="submit" class="btn btn-success">Save</button>
				          	<a href="" class="btn btn-danger">Cancel</a>
						  </div>
						</form>
			        </div>
			      </div>
			    </div>
			</div>

			<div class="modal fade" id="delete<?=$detail['contestant_id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <div class="modal-header">
			                Contestant Delete.
			            </div>
			            <div class="modal-body">
			                Are you sure to delete this contestant ?
			            </div>
			            <div class="modal-footer">
			                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			                <a href="<?= site_url('Contestant/delete/'.$detail['contestant_id'])?>" class="btn btn-danger btn-ok">Delete</a>
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
  <a class="btn btn-danger">Delete</a>&nbsp;<a class="btn btn-primary">Edit</a>&nbsp;<a class="btn btn-success" data-toggle="modal" data-target="#newContestant">New</a>

   <div class="modal fade" id="newContestant" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal to add content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Contestant Form</h4>
        </div>
        <div class="modal-body">
            <form method="post" action="<?= site_url('Contestant/contestant')?>" enctype="multipart/form-data">
			  <div class="form-group">
			    <label for="firstname">First Name</label>
			    <input data-validation="firstname" type="firstname" class="form-control" name="firstname" id="firstname" value="<?= set_value('firstname')?>">
			  </div>
			  <div class="form-group">
			    <label for="lastname">Last Name</label>
			    <input data-validation="lastname" type="text" class="form-control" name="lastname" id="lastname" value="<?= set_value('lastname')?>">
			  </div>

			  <div class="form-group">
			    <label for="dob">Date Of Birth</label>		    
			    <input data-validation="dob" type="text" class="form-control dob" name="dob" data-provide="datepicker" value="<?= set_value('dob')?>">
			  </div>

			  <div class="isActive">
			    <label><input type="checkbox" name="isActive" value="<?= (set_value('isActive'))?'selected':''?>">Is Active</label>
			  </div>

			  <div class="form-group">
			    <label for="district">District</label>
			    <select data-validation="required" type="text" class="form-control" name="district" id="district">
			    <?php 
			    	if(!empty($districts)){

			    	}foreach ($districts as $detail) {
			    		?>
			    		<option value="<?= $detail['id']?>" <?= ($detail['id']==set_value('district'))?'selected':''?>><?= $detail['name']?></option>
			    		<?php
			    	}
			    ?>
			    </select>
			  </div>
			  <div class="form-group">
			    <label>Gender:</label>
			    <label class="radio-inline">
			      <input type="radio" name="gender" value="Male" <?= (set_value('gender')=='Male')?'checked':''?>>Male
			    </label>
			    <label class="radio-inline">
			      <input type="radio" name="gender" value="Female" <?= (set_value('gender')=='Female')?'checked':''?>>Female
			    </label>			    
			  </div>

			  <div class="form-group">
			    <label for="photo">Photo</label>
			    <input type="file" class="form-control" name="photo" id="photo">
			  </div>

			  <div class="form-group">
			    <label for="address">Address</label>
			    <textarea data-validation="address" class="form-control" name="address" id="address"></textarea> 
			  </div>	

			  <div class="form-group">
			    <button type="submit" class="btn btn-success">Save</button>
	          	<a href="<?= base_url()?>" class="btn btn-danger">Cancel</a>
			  </div>
			</form>
        </div>
      </div>
      
    </div>
  </div>

</div>

<script src="<?= base_url()?>themes/js/custom-validation.js"></script>

<script type="text/javascript">

	$('.dob').datepicker({
    format: 'mm/dd/yyyy'
});

	function remove(el){
		var id=$(el).attr('data-id');
		$('#remove'+id).hide();
  		$('#photo'+id).show();
	}
</script>