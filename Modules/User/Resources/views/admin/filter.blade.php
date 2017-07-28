<form action="" method='get' id='filterForm'>
    <input type="hidden" name="page" value="1" id='page'>
    <div class='panel panel-default'>
        <div class='panel-heading'>
            <strong>Show per page:</strong>
            <select id='perPage' name='per_page'>
                @foreach($perPageArray as $val)
                    <option {{ request('per_page')==$val ? 'selected' : ''}}>{{ $val }}</option>
                @endforeach
            </select>
            
            @if( $filters )
                <button type='button' class='btn btn-sm btn-danger pull-right' id='reset'>Reset</button>
                <button type='submit' class='btn btn-sm btn-primary mr-5 pull-right'>Filter</button>
                <button type='button' class='btn btn-sm btn-default mr-5 pull-right' data-toggle='collapse' data-target='#panel'>Toggle collapse</button>
            @endif
        </div>

        @if( $filters )
            <div class='panel-body' id='panel'>
                <div class='row'>
                    @foreach($filters as $key => $val)
                        <div class='col-md-4 mt-5'>
                            <label for="{{ $val['id'] }}" class=''>{{ $val['label'] }}</label>
                            @if( $val['type'] == 'select' )
                                <select class="form-control" id="{{ $val['id'] }}" name="{{ $key }}">
                                    <option value=''>---Select---</option>
                                    @foreach($val['values'] as $key1 => $val1)
                                        <option value="{{ $key1 }}" {{ request($key)==$key1 ? 'selected' : ''}}>{{ $val1 }}</option>
                                    @endforeach
                                </select>
                            @else
                                <input type="{{ $val['type'] }}" name="{{ $key }}" id="{{ $val['id'] }}" value="{{ request($key) }}" class='form-control' autofocus>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</form>