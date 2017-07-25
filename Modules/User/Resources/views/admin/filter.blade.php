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
            <button type='button' class='btn btn-sm btn-danger pull-right' id='reset'>Reset</button>
            <button type='submit' class='btn btn-sm btn-primary mr-5 pull-right'>Filter</button>
            <button type='button' class='btn btn-sm btn-default mr-5 pull-right' data-toggle='collapse' data-target='#panel'>Toggle collapse</button>
        </div>
        <div class='panel-body' id='panel'>
            @include('user::admin.'.$template.'.filter')
        </div>
    </div>
</form>