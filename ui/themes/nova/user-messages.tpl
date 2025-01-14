{include file="sections/user-header.tpl"}
<!-- Messages Inbox -->
<div class="grid grid-cols-1 gap-6">
  <div class="card shadow-lg rounded-lg bg-white dark:bg-slate-800">
    <div class="card-body p-6">
      <!-- Header -->
      <header class="flex justify-between mb-5 items-center border-b border-slate-200 dark:border-slate-700 pb-5">
        <div class="flex-1">
          <h2 class="text-lg font-bold text-slate-900 dark:text-white">{Lang::T('Messages Inbox')}</h2>
        </div>
      </header>

      <!-- Messages List -->
      <div class="card-text">
        {if $messages|@count > 0}
        <ul class="divide-y divide-slate-200 dark:divide-slate-700">
          {foreach from=$messages item=message}
          <li class="py-4 hover:bg-slate-50 dark:hover:bg-slate-700 rounded-lg transition duration-200 ease-in-out">
            <div class="flex justify-between items-center">
              <a href="{$_url}user_messages/view/{$message.id}" class="flex-1">
                <div class="text-slate-900 dark:text-white font-medium text-lg">{$message.title}</div>
                <div class="text-slate-500 dark:text-slate-400 text-sm mt-1">{$message.date}</div>
                <!-- Corrected Line -->
                <p class="text-slate-700 dark:text-slate-300 text-sm mt-2">{$message.content|truncate:80:"..."}</p>
              </a>
              <div class="flex items-center space-x-3 rtl:space-x-reverse">
                {if $message.unread}
                <span class="px-2 py-1 text-xs font-semibold text-blue-600 bg-blue-100 dark:bg-blue-900 dark:text-blue-400 rounded-full">{Lang::T('Unread')}</span>
                {/if}
                <a href="{$_url}user_messages/mark-as-unread/{$message.id}" class="text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-white" title="{Lang::T('Mark as Unread')}">
                  <iconify-icon icon="heroicons-outline:bookmark" class="text-2xl"></iconify-icon>
                </a>
              </div>
            </div>
          </li>
          {/foreach}
        </ul>
        {else}
        <div class="text-center text-slate-500 dark:text-slate-400 py-10">
          <p class="text-lg">{Lang::T('No Messages')}</p>
        </div>
        {/if}
      </div>
    </div>
  </div>
</div>
{include file="sections/user-footer.tpl"}
