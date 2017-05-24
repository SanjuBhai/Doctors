<div id="filterbar" class="panel panel-primary">
	<div class="panel-body" >
		<div class="panel-heading">
			<h4 class="panel-title filter-heading ">
				<span>City</span>
			</h4>
		</div>
		<div id='cityBox'>
			<input type="text" name="city" id='city' class='form-control' autocomplete="off">
		</div>
		<div class="panel-heading mt-10">
			<h4 class="panel-title filter-heading ">
				<span>Locality</span>
			</h4>
		</div>
		<div id='localityBox'>
			<input type="text" name="locality" id='locality' class='form-control' autocomplete="off">
		</div>
		<div class="panel-heading mt-10">
			<h4 class="panel-title filter-heading ">
				<span>Specialization / Symptom</span>
			</h4>
		</div>
		<div id='specialityBox'>
			<input type="text" name="speciality" id='speciality' class='form-control' autocomplete="off">
		</div>
		<div class="panel-heading mt-10">
			<h4 class="panel-title filter-heading">
				<span>Clinic fees</span>
			</h4>
		</div>
		<div class="range-slider">
			<div id="double_number_range"></div>
		</div>
		<div class="panel-heading mt-10">
			<h4 class="panel-title filter-heading">
				<span>Gender</span>
			</h4>
		</div>
		<div id="genders">
			<ul class="list-group">
				<li class="list-group-item">
					<div class="checkbox" >
						<label class="custom-control custom-checkbox filter-checkbox">
						  <input class="custom-control-input" type="checkbox" value='m' id='male'>
						  <span class="custom-control-indicator checkbox-ind"></span>
						  <span class="custom-control-description">Male</span>
						</label>
					</div>
				</li>
				<li class="list-group-item">
					<div class="checkbox">
						<label class="custom-control custom-checkbox filter-checkbox">
						  <input class="custom-control-input" type="checkbox" value='f' id='female'>
						  <span class="custom-control-indicator checkbox-ind"></span>
						  <span class="custom-control-description">Female</span>
						</label>
					</div>
				</li>
			</ul>
		</div>
		<div class="panel-heading mt-10">
			<h4 class="panel-title filter-heading ">
				<span>Speciality</span>
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

		<!-- <div class="panel-heading mt-10">
			<h4 class="panel-title filter-heading">
				<span>Availabilty</span>
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
		</div> -->
	</div>
</div>

<script src="{{ url('assets/js/bootstrap3-typeahead.min.js') }} "></script>
<script src="{{ url('assets/js/range.js') }} "></script>
<link rel="stylesheet" type="text/css" href="{{ url('assets/css/range.css') }}">
<script type="text/javascript">
jQuery(function($){
   	var _token = "<?php echo csrf_token(); ?>";
   	
   	$("#double_number_range").rangepicker({
        type: "double",
        startValue: 0,
        endValue: 1000,
        translateSelectLabel: function(currentPosition, totalPosition) {
            return parseInt(1000 * (currentPosition / totalPosition));
        }
    });

   	var cityUrl = '/api/get-cities';
   	$('#city').typeahead({
      	source:  function (query, process) {
         	return $.post(cityUrl, {query: query, _token: _token}, function(response){
            	return process($.parseJSON(response));
         	});
      	}
   	});

   	var localityUrl = '/api/get-localities';
   	$('#locality').typeahead({
      	source:  function (query, process) {
         	return $.post(localityUrl, {query: $('#city').val()+' '+query, _token: _token}, function(response){
            return process($.parseJSON(response));
         	});
      	}
   	});

   	var specialityUrl = '/api/get-specialities';
   	$('#speciality').typeahead({
      source:  function (query, process) {
         return $.post(specialityUrl, {query: query, _token: _token}, function(response){
            return process($.parseJSON(response));
         });
      }
    });

	selectFilters();
	filter( window.location.hash );

	$(window).on('hashchange', function() {
		selectFilters();
		filter( window.location.hash );
	});

	$(document).on('click', '#specializations input[type="checkbox"], #localities input[type="checkbox"], #genders input[type="checkbox"]', function(){
		changeHash();
	});

	$('#city, #locality, #speciality').keydown(function(e){
		if(e.keyCode == 13 ) {
			changeHash();
			filter( window.location.hash );
		}
	});
});

function changeHash()
{
	var hash;
	var specializations = [];
	
	// Get selected specializations
	$('#specializations input[type="checkbox"]:checked').each(function(){
		specializations.push($(this).val());
	});
	
	// Get selected genders
	var genders = [];
	if( $('#male').is(':checked') ) {
		genders.push('m');
	}
	if( $('#female').is(':checked') ) {
		genders.push('f');
	}

	hash = 'find='+encodeURIComponent($('#speciality').val().trim())+'&city='+encodeURIComponent($('#city').val().trim())+'&speciality='+specializations.join(',')+'&locality='+encodeURIComponent($('#locality').val().trim())+'&gender='+genders.join(',')+'&fees=&order=&page=1';

	// Update url
	window.location.hash = hash;
}

function filter( hash = '#' )
{
	hash = decodeURIComponent( hash );
	$('#zeroresults').hide();
	$('#loader').show();
	var url = '/search';
	var _token = "<?php echo csrf_token(); ?>";
	$.post(url, {filters : hash, _token: _token}, function(response){
		$('#loader').hide();
		if( response ) {
			$('#results').html(response);
		} else {
			$('#results').html('');
			$('#zeroresults').show();
		}
	});
}

function selectFilters()
{
	var hash = window.location.hash;
	hash = decodeURIComponent( hash );
	$('#filterbar input[type="checkbox"]').prop('checked', false);

	var city = hash.match('city=(.*)&speciality');
	if( city != undefined && city[1] ) {
		$('#city').val(city[1]);
	}

	var locality = hash.match('locality=(.*)&gender');
	if( locality != undefined && locality[1] ) {
		$('#locality').val(locality[1]);
	}

	var speciality = hash.match('find=(.*)&city');
	if( speciality != undefined && speciality[1] ) {
		$('#speciality').val(speciality[1]);
	}

	// Get specialities
	var speciality = hash.match('speciality=(.*)&locality');
	if( speciality != undefined && speciality[1] )
	{
		speciality = speciality[1].split(',');
		$.each(speciality, function(index, value){
			$('#speciality-'+value).prop('checked', true);
		});
	}

	// Get genders
	var gender = hash.match('gender=(.*)&fees');
	if( gender != undefined && gender[1] )
	{
		if( gender[1].includes('m') ) {
			$('#male').prop('checked', true);
		}
		if( gender[1].includes('f') ) {
			$('#female').prop('checked', true);
		}
	}

	// Get fees
	var fees = hash.match('fees=(.*)&order');
	if( fees != undefined && fees[1] )
	{

	}
}
</script>