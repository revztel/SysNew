<?php
/* Smarty version 4.3.1, created on 2024-04-26 22:54:40
  from 'F:\xampp\htdocs\radius\system\plugin\ui\support_tickets_clients_view.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_662c06806a38b3_08370666',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4d589138faa1dfded813b0e7997b7ba8677ec5fe' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\system\\plugin\\ui\\support_tickets_clients_view.tpl',
      1 => 1713919088,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/user-header.tpl' => 1,
    'file:sections/user-footer.tpl' => 1,
  ),
),false)) {
function content_662c06806a38b3_08370666 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/user-header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div id="content_layout">
    <div class="flex flex-wrap justify-between items-center mb-4">
        <h4
            class="font-medium lg:text-2xl text-xl capitalize text-slate-900 inline-block ltr:pr-4 rtl:pl-4 mb-1 sm:mb-0">
            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/support_tickets_clients" class="btn inline-flex justify-center btn-primary active">
                <span class="flex items-center">
                    <iconify-icon class="text-2xl relative top-[1px]"
                        icon="ic:round-keyboard-arrow-left"></iconify-icon>
                    <span><?php echo Lang::T('Back');?>
</span>
                </span>
            </a>
        </h4>
        <div class="flex space-x-4 justify-end items-center rtl:space-x-reverse">
            <button class="btn inline-flex justify-center btn-dark dark:bg-slate-800 m-1" data-bs-toggle="modal"
                data-bs-target="#newEmailModal">
                <span class="flex items-center">
                    <iconify-icon class="text-xl ltr:mr-2 rtl:ml-2" icon="ph:plus-bold"></iconify-icon>
                    <span><?php echo Lang::T('Submit Ticket');?>
</span>
                </span>
            </button>
        </div>
    </div>

    <div class="chat-overlay"></div>
    <!-- main chat box -->
    <div class="flex-1">
        <div class="parent flex space-x-5 h-full rtl:space-x-reverse">
            <!-- end main message body -->
            <div class="flex-1">
                <div class="h-full card">
                    <div class="p-0 h-full body-class">
                        <?php if (!$_smarty_tpl->tpl_vars['tickets']->value['ticket_id']) {?>
                        <!-- BEGIN: Blank Page -->
                        <div class="h-full flex flex-col items-center justify-center xl:space-y-2 space-y-6"
                            id="blank-box">
                            <h4 class="text-2xl text-slate-600 dark:text-slate-300 font-medium">
                                <?php echo Lang::T('Ticket With ID: ');?>
 <?php echo $_smarty_tpl->tpl_vars['tickets']->value['ticket_id'];?>
 <?php echo Lang::T('Not Found');?>

                            </h4>
                            <div class="text-sm text-slate-500 lg:pt-0 pt-4">
                                <span class="lg:block hidden"><?php echo Lang::T('Ticket may have been deleted or you are not
                                    authorized
                                    to view it.');?>

                            </div>
                        </div>
                        <!-- END: Blank Page -->
                        <?php }?>

                        <!-- BEGIN: Messages -->


                        <div class="h-full">
                            <header class="border-b border-slate-100 dark:border-slate-700">
                                <div class="flex py-6 md:px-6 px-3 items-center">
                                    <div class="flex-1">
                                        <div class="flex space-x-3 rtl:space-x-reverse">
                                            <span
                                                class="text-slate-900 dark:text-white cursor-pointer text-xl self-center ltr:mr-3 rtl:ml-3 lg:hidden block start-chat">

                                                <iconify-icon icon="heroicons-outline:menu-alt-1"></iconify-icon>
                                            </span>

                                            <div class="flex-1 text-start">
                                                <span
                                                    class="block text-slate-800 dark:text-slate-300 text-sm font-medium mb-[2px] truncate">
                                                    <?php echo $_smarty_tpl->tpl_vars['tickets']->value['title'];?>

                                                </span>
                                                <span
                                                    class="block text-slate-500 dark:text-slate-300 text-xs font-normal">
                                                    <?php echo $_smarty_tpl->tpl_vars['tickets']->value['created'];?>

                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-none flex md:space-x-3 space-x-1 items-center rtl:space-x-reverse">
                                        <div class="msg-action-btn">

                                            <iconify-icon icon="heroicons-outline:phone"></iconify-icon>
                                        </div>
                                        <div class="msg-action-btn">

                                            <iconify-icon icon="heroicons-outline:video-camera"></iconify-icon>

                                        </div>
                                        <div class="msg-action-btn" id="hide-info">
                                            <iconify-icon icon="heroicons-outline:dots-horizontal"></iconify-icon>
                                        </div>
                                    </div>
                                </div>
                            </header>
                            <!-- header -->
                            <div class="block md:px-6 px-4">
                                <div class="input-area">
                                    <label for="DrowsTextarea" class="form-label"><?php echo Lang::T('Message:');?>
</label>
                                    <textarea id="DrowsTextarea" readonly class="form-control" rows="5"
                                        placeholder=""><?php echo $_smarty_tpl->tpl_vars['tickets']->value['message'];?>
</textarea>
                                </div>


                                <div class="chat-content parent-height bg-white dark:bg-slate-800">
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['replies']->value, 'reply');
$_smarty_tpl->tpl_vars['reply']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['reply']->value) {
$_smarty_tpl->tpl_vars['reply']->do_else = false;
?>
                                    <?php if ($_smarty_tpl->tpl_vars['reply']->value['ticket_id'] == $_smarty_tpl->tpl_vars['tickets']->value['ticket_id']) {?>
                                    <?php if ($_smarty_tpl->tpl_vars['reply']->value['reply_by'] == 'Admin') {?>
                                    <br>
                                    <!--admin reply start here-->
                                    <div class="msgs overflow-y-auto msg-height pt-6 space-y-6">

                                        <div class="flex space-x-2 items-start group rtl:space-x-reverse">
                                            <div class="flex-none">
                                                <div class="h-8 w-8 rounded-full">
                                                    <img src="https://robohash.org/<?php echo $_smarty_tpl->tpl_vars['reply']->value['userid'];?>
?set=set3&size=100x100&bgset=bg1"
                                                        onerror="this.src='system/uploads/admin.default.png'" alt=""
                                                        class="block w-full h-full object-cover rounded-full">
                                                </div>
                                            </div>
                                            <div class="flex-1 flex space-x-4 rtl:space-x-reverse">
                                                <div>
                                                    <div
                                                        class="text-contrent p-3 bg-slate-300 dark:bg-slate-900 dark:text-slate-300 text-slate-800 text-sm font-normal rounded-md flex-1 mb-1">
                                                        <?php echo $_smarty_tpl->tpl_vars['reply']->value['reply_message'];?>
</div>
                                                    <span
                                                        class="font-normal text-xs text-slate-400"><?php echo Lang::timeElapsed($_smarty_tpl->tpl_vars['reply']->value['created'],true);?>
</span>
                                                </div>
                                                <div
                                                    class="opacity-0 invisible group-hover:opacity-100 group-hover:visible">
                                                    <div class="relative inline-block">
                                                        <div class="block w-full " data-headlessui-state="">
                                                            <button class="block w-full"
                                                                id="headlessui-menu-button-:rc:" type="button"
                                                                aria-haspopup="menu" aria-expanded="false"
                                                                data-headlessui-state="">
                                                                <div class="label-class-custom">
                                                                    <div
                                                                        class="h-8 w-8 bg-slate-100 dark:bg-slate-600 dark:text-slate-300 text-slate-900 flex flex-col justify-center items-center text-xl rounded-full">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                            aria-hidden="true" role="img"
                                                                            class="iconify iconify--heroicons-outline"
                                                                            width="1em" height="1em"
                                                                            viewbox="0 0 24 24">
                                                                            <path fill="none" stroke="currentColor"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round" stroke-width="2"
                                                                                d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 1 1-2 0a1 1 0 0 1 2 0Zm7 0a1 1 0 1 1-2 0a1 1 0 0 1 2 0Zm7 0a1 1 0 1 1-2 0a1 1 0 0 1 2 0Z">
                                                                            </path>
                                                                        </svg>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--admin reply end here-->
                                    <?php }?>
                                    <?php if ($_smarty_tpl->tpl_vars['reply']->value['reply_by'] == 'User') {?>

                                    <br>
                                    <!--user reply start here-->
                                    <div class="block md:px-6 px-4">
                                        <div
                                            class="flex space-x-2 items-start justify-end group w-full rtl:space-x-reverse">
                                            <div class="no flex space-x-4 rtl:space-x-reverse">
                                                <div
                                                    class="opacity-0 invisible group-hover:opacity-100 group-hover:visible">
                                                    <div class="relative inline-block">
                                                        <div class="block w-full " data-headlessui-state="">
                                                            <button class="block w-full"
                                                                id="headlessui-menu-button-:re:" type="button"
                                                                aria-haspopup="menu" aria-expanded="false"
                                                                data-headlessui-state="">
                                                                <div class="label-class-custom">
                                                                    <div
                                                                        class="h-8 w-8 bg-slate-300 dark:bg-slate-900 dark:text-slate-400 flex flex-col justify-center items-center text-xl rounded-full text-slate-900">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                            aria-hidden="true" role="img"
                                                                            class="iconify iconify--heroicons-outline"
                                                                            width="1em" height="1em"
                                                                            viewbox="0 0 24 24">
                                                                            <path fill="none" stroke="currentColor"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round" stroke-width="2"
                                                                                d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 1 1-2 0a1 1 0 0 1 2 0Zm7 0a1 1 0 1 1-2 0a1 1 0 0 1 2 0Zm7 0a1 1 0 1 1-2 0a1 1 0 0 1 2 0Z">
                                                                            </path>
                                                                        </svg>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="break-all">
                                                    <div
                                                        class="text-contrent p-3 bg-slate-300 dark:bg-slate-900 dark:text-slate-300 text-slate-800 text-sm font-normal rounded-md flex-1 mb-1">
                                                        <?php echo $_smarty_tpl->tpl_vars['reply']->value['reply_message'];?>
</div>
                                                    <span
                                                        class="font-normal text-xs text-slate-400"><?php echo Lang::timeElapsed($_smarty_tpl->tpl_vars['reply']->value['created'],true);?>
</span>
                                                </div>
                                            </div>
                                            <div class="flex-none">
                                                <div class="h-8 w-8 rounded-full">
                                                    <img src="https://robohash.org/<?php echo $_smarty_tpl->tpl_vars['_user']->value['id'];?>
?set=set3&size=100x100&bgset=bg1"
                                                        onerror="this.src='system/uploads/user.default.jpg'" alt=""
                                                        class="block w-full h-full object-cover rounded-full">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--user reply end here-->
                                    <?php }?>
                                    <?php }?>
                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </div>
                                <br>
                            </div>
                            <!-- message -->
                            <?php if ($_smarty_tpl->tpl_vars['tickets']->value['status'] == 'closed') {?> <?php } else { ?>
                            <form action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/support_tickets_clients_reply" method="post">
                                <input type="hidden" name="ticketId" value="<?php echo $_smarty_tpl->tpl_vars['tickets']->value['ticket_id'];?>
">
                                <input type="hidden" name="userId" value="<?php echo $_smarty_tpl->tpl_vars['_user']->value['id'];?>
">
                                <input type="hidden" name="reply_by" value="User">
                                <input type="hidden" name="admin_name" value="<?php echo $_smarty_tpl->tpl_vars['_user']->value['fullname'];?>
">
                                <input type="hidden" name="csrf_token" value="<?php echo $_smarty_tpl->tpl_vars['csrfToken']->value;?>
">

                                <footer class="md:px-6 px-4 sm:flex md:space-x-4 sm:space-x-2 rtl:space-x-reverse border-t md:pt-6 pt-4 border-slate-100
  dark:border-slate-700">
                                    <div class="flex-none sm:flex hidden md:space-x-3 space-x-1 rtl:space-x-reverse">
                                        <div class="h-8 w-8 cursor-pointer bg-slate-100 dark:bg-slate-900 dark:text-slate-400 flex flex-col justify-center
        items-center text-xl rounded-full">
                                            <iconify-icon icon="heroicons-outline:link"> </iconify-icon>
                                        </div>
                                        <div class="h-8 w-8 cursor-pointer bg-slate-100 dark:bg-slate-900 dark:text-slate-400 flex flex-col justify-center
        items-center text-xl rounded-full">
                                            <iconify-icon icon="heroicons-outline:emoji-happy"> </iconify-icon>
                                        </div>
                                    </div>
                                    <div class="flex-1 relative flex space-x-3 rtl:space-x-reverse">
                                        <div class="flex-1">
                                            <textarea required name="reply" placeholder="<?php echo Lang::T('Type Message ...');?>
"
                                                class="focus:ring-0 focus:outline-0 block w-full bg-transparent dark:text-white resize-none"></textarea>
                                        </div>
                                        <div class="flex-none md:pr-0 pr-3">
                                            <button type="submit"
                                                class="h-8 w-8 bg-slate-900 text-white flex flex-col justify-center items-center text-lg rounded-full">
                                                <iconify-icon icon="heroicons-outline:paper-airplane"
                                                    class="transform rotate-[60deg]"></iconify-icon>
                                            </button>
                                        </div>
                                    </div>
                                </footer>
                            </form>
                            <?php }?>
                            <!-- end footer -->
                        </div>

                        <!-- END: Message -->
                    </div>
                </div>
            </div>
            <!-- right info bar -->
            <div class="flex-none w-[285px]" id="info-box">
                <div class="h-full card">
                    <div class="p-0 h-full card-body">

                        <!-- BEGIN: Info Area -->
                        <div data-simplebar class="h-full p-6"><br>
                            <h4 class="text-xl text-slate-900 font-medium mb-8"><?php echo Lang::T('Tickets Details');?>
</h4>
                            <ul
                                class="list-item mt-5 space-y-4 border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                                <li class="flex justify-between text-sm text-slate-600 dark:text-slate-300 leading-[1]">
                                    <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                        <span><?php echo Lang::T('Ticket ID:');?>
</span>
                                    </div>
                                    <div class="font-medium"><?php echo $_smarty_tpl->tpl_vars['tickets']->value['ticket_id'];?>
</div>
                                </li>
                                <li class="flex justify-between text-sm text-slate-600 dark:text-slate-300 leading-[1]">
                                    <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                        <span><?php echo Lang::T('Opened By:');?>
</span>
                                    </div>
                                    <div class="font-medium"><?php if ($_smarty_tpl->tpl_vars['tickets']->value['created_by'] == $_smarty_tpl->tpl_vars['_user']->value['fullname']) {?>
                                        <?php echo Lang::T('Me');?>
 <?php } else { ?>
                                        <?php echo $_smarty_tpl->tpl_vars['tickets']->value['created_by'];?>
 <?php }?></div>
                                </li>
                                <li class="flex justify-between text-sm text-slate-600 dark:text-slate-300 leading-[1]">
                                    <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                        <span><?php echo Lang::T('Department:');?>
</span>
                                    </div>
                                    <div class="font-medium"><?php echo $_smarty_tpl->tpl_vars['tickets']->value['department'];?>
</div>
                                </li>
                                <li class="flex justify-between text-sm text-slate-600 dark:text-slate-300 leading-[1]">
                                    <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                        <span><?php echo Lang::T('Priority:');?>
</span>
                                    </div>
                                    <div class="font-medium"><?php echo $_smarty_tpl->tpl_vars['tickets']->value['priority'];?>
</div>
                                </li>
                                <li class="flex justify-between text-sm text-slate-600 dark:text-slate-300 leading-[1]">
                                    <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                        <span><?php echo Lang::T('Status:');?>
</span>
                                    </div>
                                    <div class="font-medium"><?php echo $_smarty_tpl->tpl_vars['tickets']->value['status'];?>
</div>
                                </li>
                                <li class="flex justify-between text-sm text-slate-600 dark:text-slate-300 leading-[1]">
                                    <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                        <span> <?php echo Lang::T('Attachment:');?>
</span>
                                    </div>
                                    <div class="font-medium"><?php if ($_smarty_tpl->tpl_vars['tickets']->value['attachment_id']) {?> <?php $_smarty_tpl->_assignInScope('extension', pathinfo($_smarty_tpl->tpl_vars['tickets']->value['attachment_path'],PATHINFO_EXTENSION));?> <?php $_smarty_tpl->_assignInScope('attachmentType', '');?> <?php if ($_smarty_tpl->tpl_vars['extension']->value == 'jpg' || $_smarty_tpl->tpl_vars['extension']->value == 'jpeg' || $_smarty_tpl->tpl_vars['extension']->value == 'png' || $_smarty_tpl->tpl_vars['extension']->value == 'gif') {?> <?php $_smarty_tpl->_assignInScope('attachmentType', "Image");?> <?php } elseif ($_smarty_tpl->tpl_vars['extension']->value == 'pdf') {?>
                                        <?php $_smarty_tpl->_assignInScope('attachmentType', "PDF");?> <?php } elseif ($_smarty_tpl->tpl_vars['extension']->value == 'doc' || $_smarty_tpl->tpl_vars['extension']->value == 'docx') {?> <?php $_smarty_tpl->_assignInScope('attachmentType', "Word Document");?> <?php } elseif ($_smarty_tpl->tpl_vars['extension']->value == 'xls' || $_smarty_tpl->tpl_vars['extension']->value == 'xlsx') {?>
                                        <?php $_smarty_tpl->_assignInScope('attachmentType', "Excel Spreadsheet");?> <?php } elseif ($_smarty_tpl->tpl_vars['extension']->value == 'ppt' || $_smarty_tpl->tpl_vars['extension']->value == 'pptx') {?> <?php $_smarty_tpl->_assignInScope('attachmentType', "PowerPoint Presentation");?> <?php } else { ?>
                                        <?php $_smarty_tpl->_assignInScope('attachmentType', "File");?> <?php }?> <?php echo $_smarty_tpl->tpl_vars['attachmentType']->value;?>
 <?php } else { ?>
                                        <?php echo Lang::T('None');?>
 <?php }?></div>
                                </li>
                                <li class="flex justify-between text-sm text-slate-600 dark:text-slate-300 leading-[1]">
                                    <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                        <span> <?php echo Lang::T('Created Date:');?>
</span>
                                    </div>
                                    <div class="font-medium"><?php echo $_smarty_tpl->tpl_vars['ticket']->value['formattedCreated'];?>
</div>
                                </li>
                                <li class="flex justify-between text-sm text-slate-600 dark:text-slate-300 leading-[1]">
                                    <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                        <span> <?php echo Lang::T('Last Updated:');?>
</span>
                                    </div>
                                    <div class="font-medium"><?php echo $_smarty_tpl->tpl_vars['ticket']->value['formattedLastUpdated'];?>
</div>
                                </li>
                            </ul>

                            <ul
                                class="list-item space-y-3 border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6 mt-5">
                                <li class="text-sm text-slate-600 dark:text-slate-300 leading-[1]">
                                    <button class="flex space-x-2 rtl:space-x-reverse">
                                        <iconify-icon icon="bxl:facebook-circle"></iconify-icon>
                                        <span
                                            class="capitalize font-normal text-slate-600 dark:text-slate-300">facebook</span>
                                    </button>
                                </li>
                                <li class="text-sm text-slate-600 dark:text-slate-300 leading-[1]">
                                    <button class="flex space-x-2 rtl:space-x-reverse">
                                        <iconify-icon icon="radix-icons:twitter-logo"></iconify-icon>
                                        <span
                                            class="capitalize font-normal text-slate-600 dark:text-slate-300">twitter</span>
                                    </button>
                                </li>
                                <li class="text-sm text-slate-600 dark:text-slate-300 leading-[1]">
                                    <button class="flex space-x-2 rtl:space-x-reverse">
                                        <iconify-icon icon="bxl:instagram"></iconify-icon>
                                        <span
                                            class="capitalize font-normal text-slate-600 dark:text-slate-300">instagram</span>
                                    </button>
                                </li>
                            </ul>
                            <h4 class="py-4 text-sm text-secondary-500 dark:text-slate-300 font-normal"><?php echo Lang::T('Shared
                                Documents');?>
</h4>
                            <ul class="grid grid-cols-3 gap-2"> <?php if ($_smarty_tpl->tpl_vars['tickets']->value['attachment_id'] && $_smarty_tpl->tpl_vars['tickets']->value['attachment_path']) {?>
                                <?php $_smarty_tpl->_assignInScope('extension', pathinfo($_smarty_tpl->tpl_vars['tickets']->value['attachment_path'],PATHINFO_EXTENSION));?> <?php if ($_smarty_tpl->tpl_vars['extension']->value == 'jpg' || $_smarty_tpl->tpl_vars['extension']->value == 'jpeg' || $_smarty_tpl->tpl_vars['extension']->value == 'png' || $_smarty_tpl->tpl_vars['extension']->value == 'gif') {?>
                                <li class="h-[46px]">
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['tickets']->value['attachment_path'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['tickets']->value['attachment_path'];?>
"
                                            alt="Attachment" class="w-full h-full object-cover rounded-[3px]"></a>
                                </li>
                                <?php } else { ?>
                                <li class="h-[46px]">
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['tickets']->value['attachment_path'];?>
"><?php echo Lang::T('Download Attachment');?>
</a>
                                </li>
                                <?php }?>
                                <?php } else { ?>
                                <li class="h-[46px]">
                                    <?php echo Lang::T('No uploaded attachments');?>

                                </li>
                                <?php }?>
                            </ul>
                        </div>
                        <!-- END: Info Area -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- BEGIN: Modal Content -->

<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="newEmailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog relative w-auto pointer-events-none">
        <div class="modal-content border-none shadow-lg relative flex flex-col lg:w-[576px] w-full pointer-events-auto bg-white
bg-clip-padding rounded-md outline-none text-current">
            <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-slate-900 dark:bg-slate-700">
                    <h3 class="text-base font-medium text-white dark:text-white capitalize">
                        <?php echo Lang::T('Create New Ticket');?>

                    </h3>
                    <button type="button" class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center
  dark:hover:bg-slate-600 dark:hover:text-white" data-bs-dismiss="modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="#ffffff" viewbox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10
      11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-4">
                    <form action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/support_tickets_clients" method="post" enctype="multipart/form-data"
                        class="flex flex-col space-y-3">
                        <input type="hidden" class="form-control" name="created_by" value="<?php echo $_smarty_tpl->tpl_vars['_user']->value['fullname'];?>
">
                        <input type="hidden" class="form-control" name="id_customer" value="<?php echo $_smarty_tpl->tpl_vars['_user']->value['id'];?>
">
                        <input type="hidden" name="csrf_token" value="<?php echo $_smarty_tpl->tpl_vars['csrfToken']->value;?>
">
                        <div class="input-area">
                            <label for="subject" class="form-label"><?php echo Lang::T('Subject');?>
:</label>
                            <input class="form-control" name="subject" placeholder="<?php echo Lang::T('Subject');?>
" required>
                        </div>

                        <div class="input-area">
                            <label for="priority" class="form-label"><?php echo Lang::T('Priority');?>
:</label>
                            <select class="form-control" name="priority">
                                <option value="Low"><?php echo Lang::T('Low');?>
</option>
                                <option value="Medium"><?php echo Lang::T('Medium');?>
</option>
                                <option value="High"><?php echo Lang::T('High');?>
</option>
                            </select>
                        </div>
                        <div class="input-area">
                            <label for="department" class="form-label"><?php echo Lang::T('Department');?>
:</label>
                            <select class="form-control" name="department">
                                <option value="Sales Team"><?php echo Lang::T('Sales Team');?>
</option>
                                <option value="Technical Team"><?php echo Lang::T('Technical Team');?>
</option>
                                <option value="Support Team"><?php echo Lang::T('Support Team');?>
</option>
                            </select>
                        </div>
                        <div class="multiFilePreview">
                            <label for="attachment" class="form-label"><?php echo Lang::T('Attachment');?>
:</label>
                            <label>
                                <input type="file" class=" w-full hidden" name="attachment"
                                    accept=".jpg, .gif, .jpeg, .png, .pdf, .txt, .doc, .xlsx, .xls, .ppt, .pptx">
                                <span class="w-full h-[40px] file-control flex items-center custom-class">
                                    <span class="flex-1 overflow-hidden text-ellipsis whitespace-nowrap">
                                        <span class="text-slate-400"><?php echo Lang::T('Choose a file');?>
</span>
                                    </span>
                                    <span
                                        class="file-name flex-none cursor-pointer border-l px-4 border-slate-200 dark:border-slate-700 h-full inline-flex items-center bg-slate-100 dark:bg-slate-900 text-slate-600 dark:text-slate-400 text-sm rounded-tr rounded-br font-normal">Browse</span>
                                </span>
                            </label>
                            <div id="file-preview"></div>
                        </div>
                        <div class="input-area">
                            <label for="message" class="form-label"><?php echo Lang::T('Message');?>
:</label>
                            <textarea name="message" rows="5" class="form-control" placeholder="<?php echo Lang::T('Message');?>
"
                                required></textarea>
                        </div>
                        <div class="flex items-center justify-end rounded-b dark:border-slate-600">
                            <button type="submit"
                                class="btn inline-flex justify-center text-white bg-black-500">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>









<?php $_smarty_tpl->_subTemplateRender("file:sections/user-footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
