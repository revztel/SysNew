{include file="sections/header.tpl"}

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary"> <!-- Changed panel to 'primary' for a consistent look -->
            <div class="panel-heading">{Lang::T('Bulk Actions')}</div>
            <div class="panel-body">
                <div class="list-group">
                    <a href="{$_url}bulk_actions/mass_delete" class="list-group-item">
                        {Lang::T('Mass Delete Users')}
                    </a>
                    <a href="{$_url}bulk_actions/bulk_edit_expiry" class="list-group-item">
                        {Lang::T('Bulk Edit Expiry Period')}
                    </a>
                    <!-- Add more bulk actions here -->
                </div>
            </div>
        </div>
    </div>
</div>

{include file="sections/footer.tpl"}
