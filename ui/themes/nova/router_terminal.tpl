{include file="sections/header.tpl"}

<!-- Router Terminal -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                {Lang::T('Router Terminal')}
            </div>
            <div class="panel-body">
                <!-- Router Selection Form -->
                <form method="post" action="{$_url}router_terminal/terminal/">
                    <div class="form-group">
                        <label for="router_id">{Lang::T('Select Router')}</label>
                        <select name="router_id" id="router_id" class="form-control">
                            {foreach $routers as $router}
                                <option value="{$router.id}" {if isset($selected_router) && $selected_router.id == $router.id}selected{/if}>{$router.name}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="command">{Lang::T('Command')}</label>
                        <textarea name="command" id="command" class="form-control" rows="5">{if isset($command)}{$command}{/if}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">{Lang::T('Execute')}</button>
                </form>

                {if isset($output)}
                <h3>{Lang::T('Output')}</h3>
                <pre>{$output}</pre>
                {/if}
            </div>
        </div>
    </div>
</div>

{include file="sections/footer.tpl"}
