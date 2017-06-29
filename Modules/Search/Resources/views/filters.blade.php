<div id="filterbar" class="panel panel-primary">
	<div class="panel-body" >
		<input type="hidden" name="page" id='page' value='1'>
		<div class="panel-heading">
			<h4 class="panel-title filter-heading ">
				<span>{{ __('City') }}</span>
			</h4>
		</div>
		<div id='cityBox'>
			<input type="text" name="city" id='city' class='form-control' autocomplete="off">
		</div>
		<div class="panel-heading mt-10">
			<h4 class="panel-title filter-heading ">
				<span>{{ __('Locality') }}</span>
			</h4>
		</div>
		<div id='localityBox'>
			<input type="text" name="locality" id='locality' class='form-control' autocomplete="off">
		</div>
		<div class="panel-heading mt-10">
			<h4 class="panel-title filter-heading ">
				<span>{{ __('Specialization / Symptom') }}</span>
			</h4>
		</div>
		<div id='specialityBox'>
			<input type="text" name="speciality" id='speciality' class='form-control' autocomplete="off">
		</div>
		<div class="panel-heading mt-10">
			<h4 class="panel-title filter-heading">
				<span>{{ __('Clinic fees') }}</span>
			</h4>
		</div>
		<div class="range-slider">
			<div id="double_number_range"></div>
		</div>
		<div class="panel-heading mt-10">
			<h4 class="panel-title filter-heading">
				<span>{{ __('Gender') }}</span>
			</h4>
		</div>
		<div id="genders">
			<ul class="list-group">
				<li class="list-group-item">
					<div class="checkbox" >
						<label class="custom-control custom-checkbox filter-checkbox">
						  <input class="custom-control-input" type="checkbox" value='m' id='male'>
						  <span class="custom-control-indicator checkbox-ind"></span>
						  <span class="custom-control-description">{{ __('Male') }}</span>
						</label>
					</div>
				</li>
				<li class="list-group-item">
					<div class="checkbox">
						<label class="custom-control custom-checkbox filter-checkbox">
						  <input class="custom-control-input" type="checkbox" value='f' id='female'>
						  <span class="custom-control-indicator checkbox-ind"></span>
						  <span class="custom-control-description">{{ __('Female') }}</span>
						</label>
					</div>
				</li>
			</ul>
		</div>
		<div class="panel-heading mt-10">
			<h4 class="panel-title filter-heading ">
				<span>{{ __('Speciality') }}</span>
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
   	var showmoreclick = false;

   	var rangePicker = $("#double_number_range").rangepicker({
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

   	var specialityUrl = '/api/get-data';
   	$('#speciality').typeahead({
      	source:  function (query, process) {
         	return $.post(specialityUrl, {query: query, _token: _token}, function(response){
            	return process($.parseJSON(response));
         	});
      	}
    });

	selectFilters();
	filter(false, true);

	$(window).on('hashchange', function() {	
		selectFilters();
		filter( showmoreclick ? true : false );
	});

	$(document).on('click', '#specializations input[type="checkbox"], #genders input[type="checkbox"]', function(){
		$('#page').val(1);
		showmoreclick = false;
		changeHash();
	});

	$('#city, #locality, #speciality').keydown(function(e){
		if(e.keyCode == 13 ) 
		{
			$('#page').val(1);
			showmoreclick = false;
			changeHash();
			filter();
		}
	});

	$('#loadMore button').click(function(){
		var page = parseInt( $('#page').val() );
		$(this).html('loading..').attr('disabled', true);
		$('#page').val( ++page );
		showmoreclick = true;
		changeHash();
		$(this).html('Show more').attr('disabled', false);
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

	var page = parseInt($('#page').val());
	
	hash = 'find='+encodeURIComponent($('#speciality').val().trim())+'&city='+encodeURIComponent($('#city').val().trim())+'&speciality='+specializations.join(',')+'&locality='+encodeURIComponent($('#locality').val().trim())+'&gender='+genders.join(',')+'&fees=&order=&page='+page;
	
	// Update url
	window.location.hash = hash;
}

function filter( append = false, pageload = false )
{
	var hash = window.location.hash;
	hash = decodeURIComponent( hash );
	$('#zeroresults').hide();
	$('#loader').show();
	var url = '/search';
	var _token = "<?php echo csrf_token(); ?>";
	var page = parseInt( $('#page').val() );
	$.post(url, {filters : hash, _token: _token, pageload: pageload}, function(response){
		$('#loader').hide();
		response = $.parseJSON(response);
		if( response.status == 'success' )
		{
			if( response.pages > page ) {
				$('#loadMore').show();
			} else {
				$('#loadMore').hide();
			}

			if( response.data ) 
			{
				if( append == true ){
					$('#results').append(response.data);
				} else {
					$('#results').html(response.data);
				}
			} else {
				$('#results').html('');
				$('#zeroresults').show();
			}
		} else {
			alert('Failed due to some problem. Please try again.');
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

	// Get page
	var page = hash.match('page=(.*)');
	if( page != undefined && page[1] ) {
		$('#page').val(page[1]);
	}	
}
</script>