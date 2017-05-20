<div id="filterbar" class="panel panel-primary">
	<div class="panel-body" >
		<div class="panel-heading">
			<h4 class="panel-title filter-heading ">
				City
			</h4>
		</div>
		<div id='cityBox'>
			<input type="text" name="city" id='city' class='form-control'>
		</div>
		<div class="panel-heading mt-10">
			<h4 class="panel-title filter-heading ">
				SPECIALIZATION
			</h4>
		</div>
		<div id="specializations">
			<ul class="list-group">
				@foreach($specializations as $key => $val)
					<li class="list-group-item">
						<div class="checkbox">
							<label class="custom-control custom-checkbox filter-checkbox">
							  	<input id="speciality-{{ $val->id }}" class="custom-control-input" type="checkbox" value="{{ $val->id }}">
							  	<span class="custom-control-indicator checkbox-ind"></span>
							  	<span class="custom-control-description">{{ $val->name }}</span>
							</label>
						</div>
					</li>
				@endforeach
			</ul>
		</div>

		<div class="panel-heading">
			<h4 class="panel-title filter-heading ">
				LOCALITY
			</h4>
		</div>
		<div id="localities">
			<ul class="list-group">
				<li class="list-group-item">
					<div class="checkbox">
						<label class="custom-control custom-checkbox filter-checkbox">
						  <input class="custom-control-input" type="checkbox">
						  <span class="custom-control-indicator checkbox-ind"></span>
						  <span class="custom-control-description">Dwarka</span>
						</label>
					</div>
				</li>
				<li class="list-group-item">
					<div class="checkbox" >
						<label class="custom-control custom-checkbox filter-checkbox">
						  <input class="custom-control-input" type="checkbox">
						  <span class="custom-control-indicator checkbox-ind"></span>
						  <span class="custom-control-description">Dwarka</span>
						</label>
					</div>
				</li>
			</ul>
		</div>
		<div class="panel-heading">
			<h4 class="panel-title filter-heading">
				AVAILABILITY
			</h4>
		</div>
		<div id="collapse3">
			<ul class="list-group">
				<li class="list-group-item">
					<div class="checkbox">
						<label class="custom-control custom-checkbox filter-checkbox">
						  <input class="custom-control-input" type="checkbox">
						  <span class="custom-control-indicator checkbox-ind"></span>
						  <span class="custom-control-description">Today </span>
						</label>
					</div>
				</li>
				<li class="list-group-item">
					<div class="checkbox" >
						<label class="custom-control custom-checkbox filter-checkbox">
						  <input class="custom-control-input" type="checkbox">
						  <span class="custom-control-indicator checkbox-ind"></span>
						  <span class="custom-control-description">Next 3 Days</span>
						</label>
					</div>
				</li>
			</ul>
		</div>
		<!--<div class="panel-heading">
			<h4 class="panel-title filter-heading">
				CLINIC FEES
			</h4>
		</div>-->
		<!--<div  class="range-slider">
			<b>Free</b> <input id="ex2" type="text" class="span2" value="" data-slider-min="10" data-slider-max="1000" data-slider-step="5" data-slider-value="[250,450]"/> <b>RS. 1000</b>
		</div>-->
		<div class="panel-heading">
			<h4 class="panel-title filter-heading">
				Gender
			</h4>
		</div>
		<div id="genders">
			<ul class="list-group">
				<li class="list-group-item">
					<div class="checkbox" >
						<label class="custom-control custom-checkbox filter-checkbox">
						  <input class="custom-control-input" type="checkbox" value='male' id='male'>
						  <span class="custom-control-indicator checkbox-ind"></span>
						  <span class="custom-control-description">Male</span>
						</label>
					</div>
				</li>
				<li class="list-group-item">
					<div class="checkbox">
						<label class="custom-control custom-checkbox filter-checkbox">
						  <input class="custom-control-input" type="checkbox" value='female' id='female'>
						  <span class="custom-control-indicator checkbox-ind"></span>
						  <span class="custom-control-description">Female</span>
						</label>
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>

<script type="text/javascript">
jQuery(function($){
	selectFilters();
	filter( window.location.hash );

	$(window).on('hashchange', function() {
		selectFilters();
		filter( window.location.hash );
	});

	$(document).on('click', '#specializations input[type="checkbox"], #localities input[type="checkbox"], #genders input[type="checkbox"]', function(){
		changeHash();
	});

	$('#city').keydown(function(e){
		if(e.keyCode == 13 ) {
			changeHash();
			filter( window.location.hash );
		}
	});
});

function changeHash()
{
	var hash;
	var city = $('#city').val();
	var specializations = [], localities = [];
	
	// Get selected specializations
	$('#specializations input[type="checkbox"]:checked').each(function(){
		specializations.push($(this).val());
	});

	// Get selected localities
	$('#localities input[type="checkbox"]:checked').each(function(){
		localities.push($(this).val());
	});

	hash = 'city='+$('#city').val()+'&speciality='+specializations+'&locality='+localities;

	// Update url
	window.location.hash = hash;
}

function filter( hash = '#' )
{
	$('#loader').show();
	var url = '/search';
	var _token = "<?php echo csrf_token(); ?>";
	$.post(url, {filters : hash, _token: _token}, function(response){
		$('#loader').hide();
		$('#results').html(response);
	});
}

function selectFilters()
{
	var hash = window.location.hash;
	$('#filterbar input[type="checkbox"]').prop('checked', false);

	var city = hash.match('city=(.*)&speciality');
	$('#city').val(city[1]);

	// Get specialities
	var speciality = hash.match('speciality=(.*)&locality');
	if( speciality[1] )
	{
		speciality = speciality[1].split(',');
		$.each(speciality, function(index, value){
			$('#speciality-'+value).prop('checked', true);
		});
	}

	// Get localities
	var locality = hash.match('locality=(.*)&gender');
	if( locality[1] )
	{
		locality = locality[1].split(',');
		$.each(locality, function(index, value){
			$('#locality-'+value).prop('checked', true);
		});
	}

	var gender = hash.match('gender=(.*)');
	if( gender[1] )
	{
		if( gender[1].indexOf('male') != -1 ) {
			$('#male').prop('checked', true);
		}
		if( gender[1].indexOf('female') != -1 ) {
			$('#female').prop('checked', true);
		}
	}
}
</script>