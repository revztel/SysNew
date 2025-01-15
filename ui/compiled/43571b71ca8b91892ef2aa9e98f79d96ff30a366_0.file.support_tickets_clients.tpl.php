<?php
/* Smarty version 4.3.1, created on 2024-04-26 22:52:54
  from 'F:\xampp\htdocs\radius\system\plugin\ui\support_tickets_clients.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_662c0616c8b9e5_99274920',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '43571b71ca8b91892ef2aa9e98f79d96ff30a366' => 
    array (
      0 => 'F:\\xampp\\htdocs\\radius\\system\\plugin\\ui\\support_tickets_clients.tpl',
      1 => 1713918953,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/user-header.tpl' => 1,
    'file:sections/user-footer.tpl' => 1,
  ),
),false)) {
function content_662c0616c8b9e5_99274920 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/user-header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div class="flex flex-wrap justify-between items-center mb-4">
  <h4
      class="font-medium lg:text-2xl text-xl capitalize text-slate-900 inline-block ltr:pr-4 rtl:pl-4 mb-1 sm:mb-0">
      <div class="relative">
        <input type="text" class="form-control !pr-12" placeholder="<?php echo Lang::T('Search Tickets...');?>
">
        <button class="absolute right-0 top-1/2 -translate-y-1/2 w-9 h-full border-l border-l-slate-200 dark:border-l-slate-700 flex items-center justify-center">
          <iconify-icon icon="heroicons-solid:search"></iconify-icon>
        </button>
      </div>
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
<div class="card">
  <header class=" card-header noborder">
    <h4 class="card-title"><?php echo Lang::T('Your Ticket History');?>

    </h4>
  </header>
  <div class="card-body px-6 pb-6">
    <div class="overflow-x-auto -mx-6">
      <span class=" col-span-8  hidden"></span>
      <span class="  col-span-4 hidden"></span>
      <div class="inline-block min-w-full align-middle">
        <div class="overflow-hidden ">
          <table id="ticketTable" class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700">
            <thead class="bg-slate-200 dark:bg-slate-700">
              <tr>

                <th scope="col" class=" table-th ">
                  <?php echo Lang::T('Ticket ID');?>

                </th>

                <th scope="col" class=" table-th ">
                  <?php echo Lang::T('Opened By');?>

                </th>

                <th scope="col" class=" table-th ">
                  <?php echo Lang::T('Subject');?>

                </th>

                <th scope="col" class=" table-th ">
                  <?php echo Lang::T('Department');?>

                </th>

                <th scope="col" class=" table-th ">
                  <?php echo Lang::T('Priority');?>

                </th>

                <th scope="col" class=" table-th ">
                  <?php echo Lang::T('Status');?>

                </th>

                <th scope="col" class=" table-th ">
                  <?php echo Lang::T('Attachment');?>

                </th>

                <th scope="col" class=" table-th ">
                  <?php echo Lang::T('Created Date');?>

                </th>

                <th scope="col" class=" table-th ">
                  <?php echo Lang::T('Last Updated');?>

                </th>

              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sortedTickets']->value, 'ticket');
$_smarty_tpl->tpl_vars['ticket']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ticket']->value) {
$_smarty_tpl->tpl_vars['ticket']->do_else = false;
?> <tr>
                <td class="table-td"><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/support_tickets_clients_view/<?php echo $_smarty_tpl->tpl_vars['ticket']->value['ticket_id'];?>
"
                    class="ticket-link" data-toggle="tooltip" title="<?php echo $_smarty_tpl->tpl_vars['ticket']->value['message'];?>
"> <?php echo $_smarty_tpl->tpl_vars['ticket']->value['ticket_id'];?>
 </a></td>
                <td class="table-td"> <?php if ($_smarty_tpl->tpl_vars['ticket']->value['created_by'] == $_smarty_tpl->tpl_vars['_user']->value['fullname']) {?> <?php echo Lang::T('Me');?>
 <?php } else { ?>
                  <?php echo $_smarty_tpl->tpl_vars['ticket']->value['created_by'];?>
 <?php }?> </td>
                <td class="table-td"><?php echo $_smarty_tpl->tpl_vars['ticket']->value['title'];?>
</td>
                <td class="table-td"><?php echo $_smarty_tpl->tpl_vars['ticket']->value['department'];?>
</td>
                <td class="table-td">
                  <div
                    class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-<?php if ($_smarty_tpl->tpl_vars['ticket']->value['priority'] == 'Low') {?>success<?php } elseif ($_smarty_tpl->tpl_vars['ticket']->value['priority'] == 'Medium') {?>primary<?php } elseif ($_smarty_tpl->tpl_vars['ticket']->value['priority'] == 'High') {?>danger<?php }?>-500
                     bg-<?php if ($_smarty_tpl->tpl_vars['ticket']->value['priority'] == 'Low') {?>success<?php } elseif ($_smarty_tpl->tpl_vars['ticket']->value['priority'] == 'Medium') {?>primary<?php } elseif ($_smarty_tpl->tpl_vars['ticket']->value['priority'] == 'High') {?>danger<?php }?>-500">
                    <?php echo $_smarty_tpl->tpl_vars['ticket']->value['priority'];?>

                  </div>
                </td>
                <td class="table-td">
                  <div
                    class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-<?php if ($_smarty_tpl->tpl_vars['ticket']->value['status'] == 'open') {?>danger<?php } elseif ($_smarty_tpl->tpl_vars['ticket']->value['status'] == 'in_progress') {?>primary<?php } elseif ($_smarty_tpl->tpl_vars['ticket']->value['status'] == 'resolved') {?>success<?php } elseif ($_smarty_tpl->tpl_vars['ticket']->value['status'] == 'closed') {?>secondary<?php }?>-500
                     bg-<?php if ($_smarty_tpl->tpl_vars['ticket']->value['status'] == 'open') {?>danger<?php } elseif ($_smarty_tpl->tpl_vars['ticket']->value['status'] == 'in_progress') {?>primary<?php } elseif ($_smarty_tpl->tpl_vars['ticket']->value['status'] == 'resolved') {?>success<?php } elseif ($_smarty_tpl->tpl_vars['ticket']->value['status'] == 'closed') {?>secondary<?php }?>-500">
                    <?php echo $_smarty_tpl->tpl_vars['ticket']->value['status'];?>

                  </div>
                </td>
                <td class="table-td">
                  <div> <?php if ($_smarty_tpl->tpl_vars['ticket']->value['attachment_id']) {?> <?php $_smarty_tpl->_assignInScope('extension', pathinfo($_smarty_tpl->tpl_vars['ticket']->value['attachment_path'],PATHINFO_EXTENSION));?> <?php $_smarty_tpl->_assignInScope('attachmentType', '');?> <?php if ($_smarty_tpl->tpl_vars['extension']->value == 'jpg' || $_smarty_tpl->tpl_vars['extension']->value == 'jpeg' || $_smarty_tpl->tpl_vars['extension']->value == 'png' || $_smarty_tpl->tpl_vars['extension']->value == 'gif') {?> <?php $_smarty_tpl->_assignInScope('attachmentType', "Image");?> <?php } elseif ($_smarty_tpl->tpl_vars['extension']->value == 'pdf') {?> <?php $_smarty_tpl->_assignInScope('attachmentType', "PDF");?> <?php } elseif ($_smarty_tpl->tpl_vars['extension']->value == 'doc' || $_smarty_tpl->tpl_vars['extension']->value == 'docx') {?> <?php $_smarty_tpl->_assignInScope('attachmentType', "Word Document");?> <?php } elseif ($_smarty_tpl->tpl_vars['extension']->value == 'xls' || $_smarty_tpl->tpl_vars['extension']->value == 'xlsx') {?>
                    <?php $_smarty_tpl->_assignInScope('attachmentType', "Excel Spreadsheet");?> <?php } elseif ($_smarty_tpl->tpl_vars['extension']->value == 'ppt' || $_smarty_tpl->tpl_vars['extension']->value == 'pptx') {?> <?php $_smarty_tpl->_assignInScope('attachmentType', "PowerPoint Presentation");?> <?php } else { ?> <?php $_smarty_tpl->_assignInScope('attachmentType', "File");?> <?php }?> <?php echo $_smarty_tpl->tpl_vars['attachmentType']->value;?>
 <?php } else { ?> <?php echo Lang::T('None');?>
 <?php }?> </div>
                </td>
                <td class="table-td">
                  <div><?php echo $_smarty_tpl->tpl_vars['ticket']->value['formattedCreated'];?>
</div>
                </td>
                <td class="table-td">
                  <div><?php echo $_smarty_tpl->tpl_vars['ticket']->value['formattedLastUpdated'];?>
</div>
                </td>
              </tr> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </tbody>
          </table>

          <div class="card col-span-1 md:col-span-2 rounded-md bg-white dark:bg-slate-800 lg:h-full shadow-base">
            <div class="card-body flex flex-col p-6">
              <div class="card-text h-full flex flex-wrap items-center justify-between">
                <div class="flex items-center space-x-2 mb-2 sm:mb-0">
                  <?php echo Lang::T('Total Tickets');?>
: &nbsp; <b><?php echo $_smarty_tpl->tpl_vars['totalTickets']->value;?>
</b>
                </div>
                <div>
                  <ul class="list-none">
                    <?php if ($_smarty_tpl->tpl_vars['totalPages']->value > 1) {?> <?php if ($_smarty_tpl->tpl_vars['currentPage']->value > 1) {?>
                    <li class="inline-block">
                      <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/support_tickets_clients&page=<?php echo $_smarty_tpl->tpl_vars['currentPage']->value-1;?>
" class="flex items-center justify-center w-6 h-6 text-slate-600 mr-5 ml-5 text-sm font-Inter font-medium transition-all
                              duration-300 relative dark:text-white">
                        Previous
                      </a>
                    </li><?php }?>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, range(1,$_smarty_tpl->tpl_vars['totalPages']->value), 'pageNumber');
$_smarty_tpl->tpl_vars['pageNumber']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['pageNumber']->value) {
$_smarty_tpl->tpl_vars['pageNumber']->do_else = false;
?><li class="inline-block"> <?php if ($_smarty_tpl->tpl_vars['pageNumber']->value == $_smarty_tpl->tpl_vars['currentPage']->value) {?>
                      <a href="#" class="flex items-center justify-center w-6 h-6 bg-slate-100 text-slate-800
                                    dark:text-white rounded mx-[2px] sm:mx-1 hover:bg-black-500 hover:text-white text-sm font-Inter font-medium transition-all
                                    duration-300 p-active">
                        <?php echo $_smarty_tpl->tpl_vars['pageNumber']->value;?>
</a>

                      <?php } else { ?>

                      <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/support_tickets_clients&page=<?php echo $_smarty_tpl->tpl_vars['pageNumber']->value;?>
" class="flex items-center justify-center w-6 h-6 bg-slate-100 dark:bg-slate-700 dark:hover:bg-black-500 text-slate-800
                                    dark:text-white rounded mx-[2px] sm:mx-1 hover:bg-black-500 hover:text-white text-sm font-Inter font-medium transition-all
                                    duration-300 ">
                        <?php echo $_smarty_tpl->tpl_vars['pageNumber']->value;?>
</a>
                      <?php }?>
                    </li>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <?php if ($_smarty_tpl->tpl_vars['currentPage']->value < $_smarty_tpl->tpl_vars['totalPages']->value) {?> <li class="inline-block">
                      <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/support_tickets_clients&page=<?php echo $_smarty_tpl->tpl_vars['currentPage']->value+1;?>
" class="flex items-center justify-center w-6 h-6 text-slate-600 ml-3 text-sm font-Inter font-medium transition-all
                              duration-300 relative dark:text-white">
                        Next
                      </a>
                      </li>
                      <?php }?> <?php }?>
                  </ul>
                </div>
              </div>
            </div>
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
                    <form action="" method="post" enctype="multipart/form-data"
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
