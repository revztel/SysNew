{include file="sections/header.tpl"}

<!-- Hotspot Trial Profiles -->
<div class="row">
  <div class="col-sm-12">
    <div class="panel panel-hovered mb20 panel-primary">
        <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
            <span>{Lang::T('Hotspot Trial Profiles')}</span>
            <a href="{$_url}trial/add" class="btn btn-primary btn-xs">{Lang::T('Add New Trial')}</a>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-condensed">
                    <thead>
                        <tr>
                            <th>{Lang::T('Trial Name')}</th>
                            <th>{Lang::T('Assigned Plan')}</th>
                            <th>{Lang::T('Trial Uptime Limit (Minutes)')}</th>
                            <th>{Lang::T('Trial Uptime Reset (Days)')}</th>
                            <th>{Lang::T('Manage')}</th>
                            <th>ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach from=$trials item=trial}
                            <tr>
                                <td>{$trial.name}</td>
                                <td>{$trial.plan_name}</td> <!-- Display the assigned plan name -->
                                <td>{$trial.time_limit} {Lang::T('Minutes')}</td>
                                <td>{$trial.uptime_reset} {Lang::T('Days')}</td>
                                <td>
                                    <a href="{$_url}trial/edit/{$trial.id}" class="btn btn-info btn-xs">{Lang::T('Edit')}</a>
                                    <a href="{$_url}trial/delete/{$trial.id}" id="{$trial.id}" class="btn btn-danger btn-xs" onclick="return confirm('{Lang::T('Are you sure you want to delete this trial?')}')">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </a>
                                </td>
                                <td>{$trial.id}</td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>





<!-- Usage Instructions -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                <span>{Lang::T('Usage Instructions-Add One Plan At A Time and Save Changes In Hotspot Settings  ')}</span>
            </div>
            <div class="panel-body">
                <h4>{Lang::T('Overview')}</h4>
                <p>{Lang::T('Hotspot Trials allow potential customers to experience the service before committing to a paid plan. They are an excellent way to showcase the value of your offerings while controlling access and preventing abuse.')}</p>
                
                <h4>{Lang::T('Setting Up Trials')}</h4>
                <ul>
                    <li>{Lang::T('After adding each trial plan, go to the Hotspot settings for the selected router and save changes before adding another trial plan. Repeat this process for each new trial plan.')}</li>
                    <li>{Lang::T('Ensure the assigned plan is correctly configured with appropriate bandwidth and usage limits.')}</li>
                    <li>{Lang::T('Set a reasonable "Trial Uptime Limit" to control how long the trial can be used without interruptions.')}</li>
                    <li>{Lang::T('Use the "Trial Uptime Reset" feature to periodically reset the trial usage, providing flexibility for repeated trials.')}</li>
                </ul>

                <h4>{Lang::T('Best Practices')}</h4>
                <ul>
                    <li>{Lang::T('Create a new hotspot plan and name it uniquely to easily identify the associated router. For example, name the plan "Trial for Router1" (replace "Router1" with your actual router name). This naming convention will help you quickly identify and select the correct plan when configuring your trial plans for different routers.')}</li>
                    <li>{Lang::T('When creating a trial plan choose the right plan its advised to create a hotspot trial plan for each router and name it differently.')}</li>
                    <li>{Lang::T('Keep trial periods short enough to encourage conversion to paid plans, but long enough for users to see the full value.')}</li>
                    <li>{Lang::T('Communicate clearly with users about trial limits, reset intervals, and what happens when the trial ends.')}</li>
                </ul>

                <h4>{Lang::T('Troubleshooting')}</h4>
                <p>{Lang::T('If users report issues with trial connectivity or unexpected disconnections, check the uptime limits and reset intervals. Ensure that the assigned router and plan settings are correctly configured and that no conflicting settings exist.')}</p>

                <h4>{Lang::T('Additional Resources')}</h4>
                <p>{Lang::T('For further assistance and advanced configuration tips, refer to our comprehensive guide available in the support section or reach out to our technical support team.')}</p>
                
                <div class="alert alert-info">
                    <strong>{Lang::T('Tip')}:</strong> {Lang::T('NOTE:: After adding a trial plan
                    immediately go to Hotspot Settings and Save Changes on the right router before going to the next router if you have multiple routers
                   .')}</p>
                </div>
            </div>
        </div>
    </div>
</div>

{include file="sections/footer.tpl"}
