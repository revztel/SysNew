{include file="sections/header.tpl"}

<!-- Router Files Management -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                {Lang::T('Router Files Management')}
            </div>
            <div class="panel-body">
                <!-- Router Selection Form -->
                <form method="post" action="{$_url}router_files/list/">
                    <div class="form-group">
                        <label for="router_id">{Lang::T('Select Router')}</label>
                        <select name="router_id" id="router_id" class="form-control">
                            {foreach $routers as $router}
                                <option value="{$router.id}" {if isset($selected_router) && $selected_router.id == $router.id}selected{/if}>{$router.name}</option>
                            {/foreach}
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">{Lang::T('Load Files')}</button>
                </form>

                {if isset($files)}
                <h3>{Lang::T('Files on')} {$selected_router.name}</h3>

                <!-- File Upload Form -->
                <form method="post" action="{$_url}router_files/upload" enctype="multipart/form-data" id="file-upload-form">
                    <input type="hidden" name="router_id" value="{$selected_router.id}">
                    <div class="form-group">
                        <label>{Lang::T('Destination Directory')}</label>
                        <select name="destination_path" class="form-control" id="destination_path">
                            <option value="">{Lang::T('Root Directory')}</option>
                            {foreach $directories as $directory}
                            <option value="{$directory.path}">/{$directory.path}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="form-group">
                        <label>{Lang::T('Upload Files or Folders')}</label>
                        <div id="drop-zone" class="drop-zone">
                            <p>{Lang::T('Drag & drop files or folders here or click to select')}</p>
                            <input type="file" name="files[]" id="file-input" multiple webkitdirectory directory>
                        </div>
                    </div>
                    <!-- Upload button is optional since form submits automatically -->
                    <!-- <button type="submit" class="btn btn-success">{Lang::T('Upload Files')}</button> -->
                </form>

                <!-- File List -->
                <table class="table table-bordered table-striped table-condensed">
                    <thead>
                        <tr>
                            <th>{Lang::T('ID')}</th>
                            <th>{Lang::T('Name')}</th>
                            <th>{Lang::T('Type')}</th>
                            <th>{Lang::T('Size')}</th>
                            <th>{Lang::T('Creation Time')}</th>
                            <th>{Lang::T('Actions')}</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach $files as $file}
                        <tr>
                            <td>{$file.id}</td>
                            <td>{$file.name}</td>
                            <td>{$file.type}</td>
                            <td>{$file.size}</td>
                            <td>{$file.creation_time}</td>
                            <td>
                                <form method="post" action="{$_url}router_files/delete" style="display:inline;">
                                    <input type="hidden" name="router_id" value="{$selected_router.id}">
                                    <input type="hidden" name="file_name" value="{$file.name}">
                                    <button type="submit" class="btn btn-danger btn-xs">{Lang::T('Delete')}</button>
                                </form>
                            </td>
                        </tr>
                        {/foreach}
                    </tbody>
                </table>
                {/if}
            </div>
        </div>
    </div>
</div>

<!-- Drag and Drop Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    var dropZone = document.getElementById('drop-zone');
    var fileInput = document.getElementById('file-input');
    var uploadForm = document.getElementById('file-upload-form');

    dropZone.addEventListener('click', function() {
        fileInput.click();
    });

    fileInput.addEventListener('change', function() {
        uploadForm.submit();
    });

    dropZone.addEventListener('dragover', function(e) {
        e.preventDefault();
        dropZone.classList.add('dragover');
    });

    dropZone.addEventListener('dragleave', function(e) {
        e.preventDefault();
        dropZone.classList.remove('dragover');
    });

    dropZone.addEventListener('drop', function(e) {
        e.preventDefault();
        dropZone.classList.remove('dragover');
        fileInput.files = e.dataTransfer.files;
        uploadForm.submit();
    });
});
</script>

<!-- Styles for Drag and Drop -->
<style>
.drop-zone {
    border: 2px dashed #ccc;
    padding: 20px;
    text-align: center;
    cursor: pointer;
}

.drop-zone.dragover {
    background-color: #eee;
}
</style>

{include file="sections/footer.tpl"}
