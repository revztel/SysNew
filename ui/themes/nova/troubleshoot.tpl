{include file="sections/header.tpl"}

<!-- Troubleshooting Guide -->
<div class="row">
    <div class="col-sm-12">
        <h2 class="text-center">{Lang::T('Troubleshooting Guide')}</h2>
        <hr>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#hotspot" data-toggle="tab"><i class="fa fa-wifi"></i> {Lang::T('Hotspot')}</a></li>
            <li><a href="#pppoe" data-toggle="tab"><i class="fa fa-plug"></i> {Lang::T('PPPoE')}</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content" style="margin-top: 20px;">
            <!-- Hotspot Tab -->
            <div class="tab-pane fade in active" id="hotspot">
                <h3><i class="fa fa-wifi"></i> {$troubleshooting.hotspot.title}</h3>
                {if isset($troubleshooting.hotspot.description)}
                    <p>{$troubleshooting.hotspot.description}</p>
                {/if}

                {foreach from=$troubleshooting.hotspot.sections item=section}
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4 class="panel-title">{$section.title}</h4>
                        </div>
                        <div class="panel-body">
                            <p>{$section.description}</p>

                            {if isset($section.steps)}
                                <h5><i class="fa fa-list-ol"></i> {Lang::T('Steps')}</h5>
                                <ol>
                                    {foreach from=$section.steps item=step}
                                        <li>{$step}</li>
                                    {/foreach}
                                </ol>
                            {/if}

                            {if isset($section.errors)}
                                {foreach from=$section.errors item=error name=errorloop}
                                    <div class="panel-group" id="accordion-hotspot-{$smarty.foreach.errorloop.index}">
                                        <div class="panel panel-danger">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion-hotspot-{$smarty.foreach.errorloop.index}" href="#collapse-hotspot-{$smarty.foreach.errorloop.index}">
                                                        <i class="fa fa-exclamation-triangle"></i> {$error.error}
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapse-hotspot-{$smarty.foreach.errorloop.index}" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <p><strong>{Lang::T('Log Message')}:</strong></p>
                                                    <pre><code>{$error.log_message}</code></pre>
                                                    <p><strong>{Lang::T('Description')}:</strong> {$error.description}</p>
                                                    <p><strong>{Lang::T('Solution')}:</strong> {$error.solution}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {/foreach}
                            {/if}
                        </div>
                    </div>
                {/foreach}
            </div>

            <!-- PPPoE Tab -->
            <div class="tab-pane fade" id="pppoe">
                <h3><i class="fa fa-plug"></i> {$troubleshooting.pppoe.title}</h3>
                {if isset($troubleshooting.pppoe.description)}
                    <p>{$troubleshooting.pppoe.description}</p>
                {/if}

                {foreach from=$troubleshooting.pppoe.sections item=section}
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h4 class="panel-title">{$section.title}</h4>
                        </div>
                        <div class="panel-body">
                            <p>{$section.description}</p>

                            {if isset($section.steps)}
                                <h5><i class="fa fa-list-ol"></i> {Lang::T('Steps')}</h5>
                                <ol>
                                    {foreach from=$section.steps item=step}
                                        <li>{$step}</li>
                                    {/foreach}
                                </ol>
                            {/if}

                            {if isset($section.note)}
                                <div class="alert alert-warning">
                                    <strong>{Lang::T('Note')}:</strong> {$section.note}
                                </div>
                            {/if}
                        </div>
                    </div>
                {/foreach}
            </div>
        </div>
    </div>
</div>

{include file="sections/footer.tpl"}
