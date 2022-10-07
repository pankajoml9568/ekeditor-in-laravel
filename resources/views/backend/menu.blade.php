@extends('backend.master')

@section('content')
<script src="{{ url('resources/js/new-sortable.js')}}"></script>

<div class="container-fluid">
  <h2><span>Menus</span></h2>

  <div class="content info-box">		
    <a href="{{url('manage-menus?id=new')}}">Create a new menu</a>.	
  </div>

  <div class="row" id="main-row">				
	<div class="col-sm-3 cat-form @if(count($menus) == 0) disabled @endif">
      <h3><span>Add Menu Items</span></h3>			

	  <div class="panel-group" id="menu-items">
		<div class="panel panel-default">
	      <div class="panel-heading">
			<a href="#categories-list" data-toggle="collapse" data-parent="#menu-items">Categories <span class="caret pull-right"></span></a>
		  </div>
		  <div class="panel-collapse collapse in" id="categories-list">
		    <div class="panel-body">						
			  <div class="item-list-body">
				  <p><input type="checkbox" name="select-category[]" value="1"> Cat 1</p>
				  <p><input type="checkbox" name="select-category[]" value="2"> Cat 2</p>
				  <p><input type="checkbox" name="select-category[]" value="3"> Cat 3</p>
			  </div>	
			  <div class="item-list-footer">
			    <label class="btn btn-sm btn-default"><input type="checkbox" id="select-all-categories"> Select All</label>
				  <button type="button" class="pull-right btn btn-default btn-sm" id="add-categories">Add to Menu</button>
			</div>
		  </div>						
		</div>
		<script>
		  $('#select-all-categories').click(function(event) {   
			if(this.checked) {
			  $('#categories-list :checkbox').each(function() {
			    this.checked = true;                        
			  });
			}else{
			  $('#categories-list :checkbox').each(function() {
			    this.checked = false;                        
			  });
			}
		  });
		</script>
	  </div>
	  <div class="panel panel-default">
	    <div class="panel-heading">
		  <a href="#posts-list" data-toggle="collapse" data-parent="#menu-items">posts <span class="caret pull-right"></span></a>
		</div>
		<div class="panel-collapse collapse" id="posts-list">
		  <div class="panel-body">						
			<div class="item-list-body">
				<p><input type="checkbox" name="select-post[]" value="1"> Post 1 </p>
				<p><input type="checkbox" name="select-post[]" value="2"> Post 2 </p>
				<p><input type="checkbox" name="select-post[]" value="3"> Post 3 </p>
			</div>	
			<div class="item-list-footer">
			  <label class="btn btn-sm btn-default"><input type="checkbox" id="select-all-posts"> Select All</label>
			  <button type="button" id="add-posts" class="pull-right btn btn-default btn-sm">Add to Menu</button>
			</div>
		  </div>						
		</div>
		<script>
		  $('#select-all-posts').click(function(event) {   
		    if(this.checked) {
			  $('#posts-list :checkbox').each(function() {
				this.checked = true;                        
			  });
			}else{
			  $('#posts-list :checkbox').each(function() {
				this.checked = false;                        
			  });
			}
		  });
		</script>
	  </div>
	  <div class="panel panel-default">
		<div class="panel-heading">
	      <a href="#custom-links" data-toggle="collapse" data-parent="#menu-items">Custom Links <span class="caret pull-right"></span></a>
		</div>
		<div class="panel-collapse collapse" id="custom-links">
		  <div class="panel-body">						
			<div class="item-list-body">
			  <div class="form-group">
				<label>URL</label>
				<input type="url" id="url" class="form-control" placeholder="https://">
			  </div>
			  <div class="form-group">
				<label>Link Text</label>
			      <input type="text" id="linktext" class="form-control" placeholder="">
				</div>
			  </div>	
			  <div class="item-list-footer">
				<button type="button" class="pull-right btn btn-default btn-sm" id="add-custom-link">Add to Menu</button>
			  </div>
			</div>
		  </div>
		</div>
	  </div>		
	</div>		

	<div class="col-sm-9 cat-view">
	  <h3><span>Menu Structure</span></h3>
	  @if(count($menus)== 0)
	    <h4>Create New Menu</h4>
	    <form method="post" action="{{url('create-menu')}}">
		  {{csrf_field()}}
		  <div class="row">
		    <div class="col-sm-12">
		      <label>Name</label>
			</div>
			<div class="col-sm-6">
			  <div class="form-group">							
			    <input type="text" name="title" class="form-control">
			  </div>
			</div>
			<div class="col-sm-6 text-right">
			  <button class="btn btn-sm btn-primary">Create Menu</button>
			</div>
		  </div>
		</form>			
	  @endif			 					
	</div>
  </div>
</div>
<style>
  .item-list,.info-box{background: #fff;padding: 10px;}
  .item-list-body{max-height: 300px;overflow-y: scroll;}
  .panel-body p{margin-bottom: 5px;}
  .info-box{margin-bottom: 15px;}
  .item-list-footer{padding-top: 10px;}
  .panel-heading a{display: block;}
  .form-inline{display: inline;}
  .form-inline select{padding: 4px 10px;}
  .btn-menu-select{padding: 4px 10px}
  .disabled{pointer-events: none; opacity: 0.7;}
</style>
@endsection