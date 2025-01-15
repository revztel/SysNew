{include file="sections/user-header.tpl"}
<!-- Message View -->
<div class="grid grid-cols-1 gap-6">
  <div class="card shadow-lg rounded-lg bg-white dark:bg-slate-800">
    <div class="card-body p-6">
      <header class="flex justify-between mb-5 items-center border-b border-slate-200 dark:border-slate-700 pb-5">
        <div class="flex-1">
          <h2 class="text-lg font-bold text-slate-900 dark:text-white">{$message.title}</h2>
          <p class="text-sm text-slate-500 dark:text-slate-400">{$message.date}</p>
        </div>
        <div class="flex space-x-4 rtl:space-x-reverse">
          <a href="{$_url}user_messages/mark-as-unread/{$message.id}" class="flex items-center text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-white" title="{Lang::T('Mark as Unread')}">
            <iconify-icon icon="heroicons-outline:bookmark" class="text-2xl"></iconify-icon>
            <span class="ml-2 hidden sm:inline-block">{Lang::T('Mark as Unread')}</span>
          </a>
        </div>
      </header>

      <div class="bg-gray-50 dark:bg-slate-700 rounded-md p-4 mb-5">
        <p class="text-slate-800 dark:text-slate-200">
          <!-- Display personalized message content -->
          {$message.content}
        </p>
      </div>

      <div class="flex justify-between items-center mt-6">
        <a href="{$_url}user_messages/inbox" class="btn bg-slate-500 hover:bg-slate-600 text-white rounded-lg px-4 py-2">
          <iconify-icon icon="heroicons-outline:arrow-left" class="text-xl mr-2"></iconify-icon>
          {Lang::T('Back to Inbox')}
        </a>
        <a href="{$_url}user_messages/delete/{$message.id}" class="btn bg-red-500 hover:bg-red-600 text-white rounded-lg px-4 py-2">
          <iconify-icon icon="heroicons-outline:trash" class="text-xl mr-2"></iconify-icon>
          {Lang::T('Delete Message')}
        </a>
      </div>
    </div>
  </div>
</div>
{include file="sections/user-footer.tpl"}
