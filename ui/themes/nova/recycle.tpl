{include file="sections/header.tpl"}

<!-- Recycle Bin -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                <span>{Lang::T('Recycle Bin')}</span>
                <div>
                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmEmptyRecycleBin()">
                        {Lang::T('Empty Recycle Bin')}
                    </button>
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tutorialModal">
                        {Lang::T('Need Help?')}
                    </button>
                </div>
            </div>
            <div class="panel-body">
                <div class="md-whiteframe-z1 mb20 text-center" style="padding: 15px">
                    <div class="col-md-8">
                        <form id="site-search" method="post" action="{$_url}recycle/list/">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="fa fa-search"></span>
                                </div>
                                <input type="text" name="search" class="form-control" placeholder="{Lang::T('Search by Item Name or ID')}...">
                                <div class="input-group-btn">
                                    <button class="btn btn-success" type="submit">{Lang::T('Search')}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <!-- You can add any buttons or links here if needed -->
                    </div>&nbsp;
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                            <tr>
                                <th>{Lang::T('ID')}</th>
                                <!-- Removed Original Table column -->
                                <th>{Lang::T('Original ID')}</th>
                                <th>{Lang::T('Deleted By')}</th>
                                <th>{Lang::T('Deleted At')}</th>
                                <th>{Lang::T('Item Details')}</th>
                                <th>{Lang::T('Actions')}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $items as $item}
                            <tr>
                                <td>{$item.id}</td>
                                <!-- Removed Original Table column -->
                                <td>{$item.original_id}</td>
                                <td>{$item.deleted_by_username}</td>
                                <td>{$item.deleted_at}</td>
                                <td>
                                    <!-- Display a summary of the data -->
                                    {if $item.data_summary.username}
                                        {Lang::T('Customer')} - {$item.data_summary.username}
                                    {elseif $item.data_summary.name}
                                        {Lang::T('Router')} - {$item.data_summary.name}
                                    {elseif $item.data_summary.name_plan}
                                        {Lang::T('Plan')} - {$item.data_summary.name_plan}
                                    {else}
                                        {Lang::T('Unknown Item')}
                                    {/if}
                                </td>
                                <td>
                                    <a href="{$_url}recycle/restore/{$item.id}" class="btn btn-success btn-xs">{Lang::T('Restore')}</a>
                                    <a href="javascript:void(0);" onclick="confirmPermanentDelete('{$item.id}', '{$item.data_summary.name|escape:'javascript'}')" class="btn btn-danger btn-xs">{Lang::T('Delete Permanently')}</a>
                                </td>
                            </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>
                <!-- If you have pagination, include it here -->
                {$paginator['contents']}
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modals -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmPermanentDelete(itemId, itemName) {
    Swal.fire({
        title: '{Lang::T('Are you sure?')}',
        text: "{Lang::T('This action will permanently delete')} " + itemName + ". {Lang::T('You will not be able to recover this item!')}",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: '{Lang::T('Yes, delete it!')}'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "{$_url}recycle/delete/" + itemId;
        }
    });
}

function confirmEmptyRecycleBin() {
    Swal.fire({
        title: '{Lang::T('Are you sure?')}',
        text: "{Lang::T('This action will permanently delete all items in the recycle bin. You will not be able to recover them!')}",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: '{Lang::T('Yes, empty it!')}'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "{$_url}recycle/empty";
        }
    });
}
</script>

{include file="sections/footer.tpl"}
