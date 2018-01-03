<?php
// file: view/layouts/modalAddform.php
?>
<!-- The Modal -->
<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <div class="close">&times;</div>
      <h2><?= i18n("Add Users to notification")?></h2>
    </div>
    <div class="modal-body">
      <form id="form-select-notification_users" action="index.php?controller=notifications_user&amp;action=updatetemporalusers" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_notification" value="<?= $notification->getId() ?>"/>
      <table id="table-content">
        <tr class="table-row-content">
          <td>
            <?= i18n("Select")?>
          </td>
          <td>
            <?= i18n("User")?>
          </td>
          <?php $count = 0;
          foreach ($users as $my_user): ?>
            <tr class="table-row-content">
              <td>
                <?php $checked = '';
                  if ($notification_users != NULL):
                    foreach ($notification_users as $checked_user): ?>
                      <?php if($my_user->getId()== $checked_user->getId()): ?>
                        <?php $checked = 'checked'; ?>
                      <?php endif; ?>
                    <?php endforeach;
                  endif; ?>
                <input class="check_box" type="checkbox" id="checkbox_<?= ++$count ?>" name="checkbox[]" value="<?= $my_user->getId() ?>" <?= $checked ?>/>
              </td>
              <td><?= $my_user->getSurname() ?>, <?= $my_user->getName()?></td>
            </tr>
          <?php endforeach; ?>
        </table>
      </div>
    </form>
      <div class="modal-footer">
        <div class="content-title">
          <input id="submit2-modal" type="submit" name="submit2" form="form-select-notification_users" value="<?= i18n("Update users") ?>"/>
        </div>
      </div>
    </div>

  </div>

  <script>
  // Get the modal
  var modal = document.getElementById('myModal');
  // Get the button that opens the modal
  var btn = document.getElementById("BtnModalForm");
  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];
  // When the user clicks the button, open the modal
  btn.onclick = function() {
    $('#myModal').css('display', 'flex');
  }
  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }
  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
  // Change checkbox icons
  $('.check_box').each(function(){
    $(this).hide().after('<label class="checkbox_label"></label>');

});

$('.checkbox_label').on('click',function(){
    $(this).toggleClass('checked').prev().prop('checked',$(this).is('.checked'))
});

</script>
